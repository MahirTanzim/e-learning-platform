<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function showPaymentForm(Course $course)
    {
        // Check if user is already enrolled
        if (auth()->user()->isEnrolledIn($course->id)) {
            return redirect()->route('student.courses.show', $course)
                           ->with('info', 'You are already enrolled in this course.');
        }

        return view('payment.form', compact('course'));
    }

    public function processPayment(Request $request, Course $course)
    {
        $request->validate([
            'card_number' => 'required|string|size:16',
            'expiry_month' => 'required|integer|between:1,12',
            'expiry_year' => 'required|integer|min:' . date('Y'),
            'cvv' => 'required|string|size:3',
            'cardholder_name' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            // Simulate payment processing (dummy gateway)
            $paymentResult = $this->processDummyPayment($request, $course);

            if ($paymentResult['success']) {
                // Create enrollment
                $enrollment = Enrollment::create([
                    'student_id' => auth()->id(),
                    'course_id' => $course->id,
                    'enrolled_at' => now(),
                    'payment_amount' => $course->price,
                    'payment_status' => 'completed',
                    'payment_method' => 'credit_card',
                    'transaction_id' => $paymentResult['transaction_id'],
                    'payment_date' => now(),
                ]);

                DB::commit();

                return redirect()->route('student.courses.show', $course)
                               ->with('success', 'Payment successful! You are now enrolled in the course.');
            } else {
                DB::rollBack();
                return back()->withErrors(['payment' => 'Payment failed: ' . $paymentResult['message']]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['payment' => 'An error occurred during payment processing.']);
        }
    }

    private function processDummyPayment(Request $request, Course $course)
    {
        // Simulate payment processing delay
        sleep(1);

        // Simulate payment failure for certain card numbers (for testing)
        if (in_array($request->card_number, ['0000000000000000', '1111111111111111'])) {
            return [
                'success' => false,
                'message' => 'Card declined. Please try another card.',
                'transaction_id' => null,
            ];
        }

        // Simulate successful payment
        return [
            'success' => true,
            'message' => 'Payment processed successfully',
            'transaction_id' => 'TXN_' . time() . '_' . rand(1000, 9999),
        ];
    }

    public function paymentSuccess(Course $course)
    {
        return view('payment.success', compact('course'));
    }

    public function paymentFailed(Course $course)
    {
        return view('payment.failed', compact('course'));
    }
}
