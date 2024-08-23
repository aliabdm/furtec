<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'receiver_name' => 'required',
            'room_id' => 'required|integer|exists:rooms,id',
            'workshop_id' => 'required|integer|exists:workshops,id',
            'delivery_date' => 'required|string',
            'status' => 'required|integer|in:' . implode(',', [
                Order::PENDING,
                Order::PROCESSING,
                Order::COMPLETED,
                Order::RECEIVED,
                Order::CANCELLED,
            ]),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
