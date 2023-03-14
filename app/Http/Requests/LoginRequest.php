<?php

namespace App\Http\Requests;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "email" => ["required", "string", "email"],
            "password" => ["required", "string"],
        ];
    }

    public function authenticate(): Object
    {
        //Configure the attempts rate
        $rate = 5;

        //Check if the user don't exist the attempt limit
        $this->ensureIsNotRateLimited($rate);

        if(!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'notmatch' => "The provided credentials is not match. The remaining attempt is " . ($rate - RateLimiter::attempts($this->throttleKey()))
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        return Auth::user();
    }

    public function ensureIsNotRateLimited($rate): void 
    {
        if(!RateLimiter::tooManyAttempts($this->throttleKey(), $rate)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower(($this->input('email')). '|' . $this->ip()));
    }
}
