<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');

        * {
            font-family: 'Inter', sans-serif;
            line-height: 23px;
            text-decoration: none
        }
    </style>
</head>
<body id="kt_body" class="auth-bg" style="background-color:#D5D9E2; padding-top: 40px !important;  padding-bottom: 40px !important;">
<div class="d-flex flex-column flex-root mt-5">
    <div class="d-flex flex-column flex-column-fluid">
        <div class="scroll-y flex-column-fluid px-10 py-10" data-kt-scroll="true" data-kt-scroll-activate="true"
             data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header_nav" data-kt-scroll-offset="5px"
             data-kt-scroll-save-state="true"
             style="background-color:#D5D9E2; --kt-scrollbar-color: #d9d0cc; --kt-scrollbar-hover-color: #d9d0cc">
            <style>html, body {
                    padding: 0;
                    margin: 0;
                    font-family: Inter, Helvetica, "sans-serif";
                }

                a:hover {
                    color: #009ef7;
                }</style>
            <div id="#kt_app_body_content"
                 style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
                <div
                    style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:60px auto; max-width: 600px;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                           style="border-collapse:collapse;">
                        <tbody>
                        <tr>
                            <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">
                                <div style="text-align:center; margin:0 60px 34px 60px">
                                    <div style="margin-bottom: 10px">
                                        <img alt="Logo"
                                             src="https://storage.dinas.social/storage/public_aset/aplans-boster.png"
                                             style="height: 35px"/>
                                    </div>
                                    <div
                                        style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                                        <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">
                                            Hai, {{ $email }}</p>
                                        <p style="margin-bottom:2px; color:#7E8299">Hore.. Akun kamu berhasil dibuat
                                            <br> langkah selanjutnya silakan lakukan verifikasi akun<br> tekan tombol
                                            di bawah ini untuk melakukan verifikasi Akun</p>
                                    </div>
                                    <a href="{{ $token }}" target="_blank"
                                       style="background-color:#DD2153; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500; font-family:Arial,Helvetica,sans-serif;">Verifikasi
                                        Akun</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="center"
                                style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                                <p style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px">Dinas
                                    Sosial Kota Medan</p>
                                <p style="margin-bottom:2px; line-height: 20px;">Jl. Pinang Baris No. 114 <br>Lalang,
                                    Kec. Medan Sunggal <br>Kota Medan, Sumatera Utara 20127</p>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="center"
                                style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                                <p>{{ date('Y') }} &copy; Dinas Sosial kota Medan</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>