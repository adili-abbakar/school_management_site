<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f4f6f9;padding:40px 0;">
        <tr>
            <td align="center">

                <table role="presentation" width="600" cellspacing="0" cellpadding="0"
                    style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 3px 10px rgba(0,0,0,.08);">

                    <!-- Header -->
                    <tr>
                        <td align="center"
                            style="background:#0f172a;padding:30px;color:#ffffff;font-size:28px;font-weight:bold;">
                            {{ config('app.name') }}
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:40px;color:#374151;line-height:1.7;">

                            <h2 style="margin-top:0;color:#111827;">
                                Password Reset Request
                            </h2>

                            <p>
                                Hello {{ $user->first_name ?? 'there' }},
                            </p>

                            <p>
                                We received a request to reset the password for your
                                <strong>{{ config('app.name') }}</strong> account.
                            </p>

                            <p>
                                <strong>Account Email:</strong><br>
                                {{ $user->email }}
                            </p>

                            <p>
                                Click the button below to create a new password.
                            </p>

                            <table role="presentation" cellspacing="0" cellpadding="0" style="margin:35px auto;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ route('password.reset', [
                                            'token' => $token,
                                            'email' => $user->email,
                                        ]) }}"
                                            style="
                                            background:#2563eb;
                                            color:#ffffff;
                                            text-decoration:none;
                                            padding:15px 35px;
                                            border-radius:6px;
                                            display:inline-block;
                                            font-weight:bold;
                                            font-size:16px;">
                                            Reset Password
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p>
                                This password reset link will expire in
                                <strong>60 minutes</strong>.
                            </p>

                            <p>
                                If the button above doesn't work, copy and paste the following URL into your browser:
                            </p>

                            <p
                                style="
                            background:#f3f4f6;
                            padding:15px;
                            border-radius:6px;
                            word-break:break-all;
                            font-size:14px;
                            color:#1f2937;">

                                {{ route('password.reset', [
                                    'token' => $token,
                                    'email' => $user->email,
                                ]) }}

                            </p>

                            <hr style="margin:35px 0;border:none;border-top:1px solid #e5e7eb;">

                            <p style="font-size:14px;color:#6b7280;">
                                If you did not request this password reset, you can safely ignore this email.
                                Your password will remain unchanged, and no further action is required.
                            </p>

                            <p style="margin-top:30px;">
                                Kind regards,<br>
                                <strong>{{ config('app.name') }} Support Team</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background:#f9fafb;padding:20px;color:#9ca3af;font-size:13px;">

                            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
