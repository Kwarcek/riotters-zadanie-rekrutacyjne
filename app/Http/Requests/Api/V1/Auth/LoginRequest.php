<?php

namespace app\Http\Requests\Api\V1\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = User::query()
            ->where('email', $this->input('email'))
            ->first();

        if (!$user || !Hash::check($this->input('password'), $user->password)) {
            throw new UnauthorizedException('', Response::HTTP_UNAUTHORIZED);
        }
    }
}
