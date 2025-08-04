<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust if you implement role-based access later
    }

    public function rules(): array
    {
        return [
            'requestor_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'issue' => 'required|string|min:10',
            'remarks' => 'nullable|string|max:1000',
        ];
    }
}
