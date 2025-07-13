<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #eeeeee; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">

                    <!-- Logo -->
                    <tr>
                        <td align="center" style="padding: 30px 20px 10px;">
                            <img src="{{ asset('images/monobi_logo.png') }}" alt="Monobi Logo" width="160"
                                style="margin-bottom: 10px;">
                        </td>
                    </tr>

                    <!-- Title -->
                    <tr>
                        <td align="center" style="padding: 0 30px;">
                            <h2 style="color: #333; margin: 0;">Permintaan Reset Password</h2>
                            <p style="margin-top: 10px; font-size: 15px; color: #555;">
                                Kami menerima permintaan untuk mereset password akun Anda di <strong>Monobi</strong>.
                                Klik tombol di bawah untuk mengatur ulang password Anda.
                            </p>
                        </td>
                    </tr>

                    <!-- Tombol Reset -->
                    <tr>
                        <td align="center" style="padding: 20px 30px;">
                            <a href="{{ $reset_link }}"
                                style="display: inline-block; background-color: #1976d2; color: #fff; padding: 12px 30px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                                Atur Ulang Password
                            </a>
                        </td>
                    </tr>

                    <!-- Catatan -->
                    <tr>
                        <td style="padding: 0 30px 20px; font-size: 13px; color: #666;">
                            <p style="margin: 0;">
                                Tautan ini hanya berlaku selama 60 menit. Jika Anda tidak meminta reset password,
                                abaikan email ini.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding: 20px; font-size: 12px; color: #999;">
                            &copy; {{ date('Y') }} Monobi. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
