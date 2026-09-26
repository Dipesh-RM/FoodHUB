{{-- resources/views/emails/vendor-request-notification.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Hotel Registration - Chakhajza</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #f9fafb;
            padding: 40px 20px;
            color: #1F2937;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 20px;
            padding: 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* ========== HEADER ========== */
        .header {
            background: linear-gradient(135deg, #E85D04 0%, #DC2F02 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #FFF3E0, #F48C06, #FFF3E0);
        }

        .logo-container {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 15px;
        }

        .logo-text {
            font-family: 'Poppins', Arial, sans-serif;
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .logo-text span {
            color: #FFD700;
        }

        .logo-sub {
            color: rgba(255, 255, 255, 0.7);
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .header h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            margin-top: 10px;
            font-family: 'Poppins', Arial, sans-serif;
        }

        .header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 15px;
            margin-top: 6px;
        }

        /* ========== CONTENT ========== */
        .content {
            padding: 35px 30px;
        }

        /* Alert Badge */
        .alert-badge {
            display: inline-block;
            background: #FEF3C7;
            color: #92400E;
            font-size: 13px;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 50px;
            margin-bottom: 20px;
        }

        .alert-badge i {
            margin-right: 6px;
        }

        /* Greeting */
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 6px;
        }

        .greeting span {
            color: #E85D04;
        }

        .sub-greeting {
            color: #6B7280;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Vendor Info Card */
        .info-card {
            background: #F9FAFB;
            border-radius: 14px;
            padding: 20px 24px;
            margin: 20px 0;
            border-left: 4px solid #E85D04;
        }

        .info-card .label {
            font-size: 11px;
            font-weight: 600;
            color: #9CA3AF;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-card .value {
            font-size: 15px;
            font-weight: 500;
            color: #1F2937;
            margin-bottom: 12px;
        }

        .info-card .value:last-child {
            margin-bottom: 0;
        }

        /* Divider */
        .divider {
            border: none;
            border-top: 1px solid #E5E7EB;
            margin: 24px 0;
        }

        /* ========== ACTION BUTTONS ========== */
        .actions {
            text-align: center;
            margin: 28px 0 20px 0;
        }

        .btn-primary {
            display: inline-block;
            background: linear-gradient(135deg, #E85D04 0%, #DC2F02 100%);
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            padding: 14px 36px;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(232, 93, 4, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(232, 93, 4, 0.4);
        }

        .btn-secondary {
            display: inline-block;
            background: transparent;
            color: #6B7280;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            padding: 12px 28px;
            border-radius: 12px;
            border: 2px solid #E5E7EB;
            transition: all 0.3s ease;
            margin-left: 10px;
        }

        .btn-secondary:hover {
            border-color: #E85D04;
            color: #E85D04;
        }

        /* ========== FOOTER ========== */
        .footer {
            background: #F9FAFB;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #E5E7EB;
        }

        .footer p {
            font-size: 13px;
            color: #9CA3AF;
            line-height: 1.6;
        }

        .footer a {
            color: #E85D04;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .footer .social-icons {
            margin-top: 12px;
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .footer .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: #E5E7EB;
            border-radius: 50%;
            color: #6B7280;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .footer .social-icons a:hover {
            background: #E85D04;
            color: #ffffff;
        }

        .footer .copyright {
            font-size: 12px;
            color: #D1D5DB;
            margin-top: 12px;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 480px) {
            .content {
                padding: 24px 18px;
            }

            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 20px;
            }

            .btn-primary,
            .btn-secondary {
                display: block;
                width: 100%;
                margin: 8px 0;
                text-align: center;
            }

            .btn-secondary {
                margin-left: 0;
            }

            .info-card {
                padding: 16px 18px;
            }

            .footer {
                padding: 20px 18px;
            }

            .logo-text {
                font-size: 22px;
            }

            .actions {
                margin: 20px 0 16px 0;
            }
        }
    </style>
</head>
<body>

    <div class="container">

        <!-- ========================================== -->
        <!-- HEADER -->
        <!-- ========================================== -->
        <div class="header">
            <div class="logo-container">
                <div class="logo-text">Food<span>HUB</span></div>
                <div class="logo-sub">Discover Local Food</div>
            </div>
            <h1>🔔 New Hotel Registration</h1>
            <p>A new hotel has registered on the platform</p>
        </div>

        <!-- ========================================== -->
        <!-- CONTENT -->
        <!-- ========================================== -->
        <div class="content">

            <!-- Alert Badge -->
            <div style="text-align: center;">
                <span class="alert-badge">
                    ⚡ Pending Approval
                </span>
            </div>

            <!-- Greeting -->
            <p class="greeting">Hello Admin 👋</p>
            <p class="sub-greeting">
                A new hotel has submitted a registration request and is waiting for your review.
            </p>

            <!-- Divider -->
            <hr class="divider">

            <!-- Vendor Information -->
            <h3 style="font-size: 14px; font-weight: 600; color: #6B7280; margin-bottom: 16px;">
                🏨 Vendor Details
            </h3>

            <div class="info-card">
                <div class="label">Hotel / Company Name</div>
                <div class="value" style="font-size: 17px; font-weight: 600; color: #1F2937;">
                    {{ $vendor->company_name }}
                </div>

                <div class="label">Contact Person</div>
                <div class="value">{{ $vendor->name }}</div>

                <div class="label">Email Address</div>
                <div class="value">
                    <a href="mailto:{{ $vendor->email }}" style="color: #E85D04; text-decoration: none;">
                        {{ $vendor->email }}
                    </a>
                </div>

                <div class="label">Contact Number</div>
                <div class="value">{{ $vendor->contact_no ?? 'Not provided' }}</div>

                <div class="label">Registration Number</div>
                <div class="value">{{ $vendor->reg_no ?? 'Not provided' }}</div>

                @if($vendor->logo)
                <div class="label">Logo</div>
                <div class="value">
                    <a href="{{ asset('storage/' . $vendor->logo) }}"
                       target="_blank"
                       style="color: #E85D04; text-decoration: none; font-weight: 500;">
                        📷 View Logo
                    </a>
                </div>
                @endif

                <div class="label">Registration Date</div>
                <div class="value">{{ $vendor->created_at->format('F j, Y, g:i A') }}</div>

                <div class="label">Status</div>
                <div class="value">
                    <span style="display: inline-block; background: #FEF3C7; color: #92400E; padding: 4px 12px; border-radius: 50px; font-size: 13px; font-weight: 500;">
                        ⏳ Pending Review
                    </span>
                </div>
            </div>

            <!-- Divider -->
            <hr class="divider">

            <!-- Quick Stats -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin: 20px 0;">
                <div style="background: #F9FAFB; border-radius: 10px; padding: 14px; text-align: center;">
                    <div style="font-size: 20px; font-weight: 700; color: #E85D04;">
                        {{ \App\Models\Vendors::where('status', 'pending')->count() }}
                    </div>
                    <div style="font-size: 11px; color: #9CA3AF; font-weight: 500;">Pending</div>
                </div>
                <div style="background: #F9FAFB; border-radius: 10px; padding: 14px; text-align: center;">
                    <div style="font-size: 20px; font-weight: 700; color: #10B981;">
                        {{ \App\Models\Vendors::where('status', 'approved')->count() }}
                    </div>
                    <div style="font-size: 11px; color: #9CA3AF; font-weight: 500;">Approved</div>
                </div>
                <div style="background: #F9FAFB; border-radius: 10px; padding: 14px; text-align: center;">
                    <div style="font-size: 20px; font-weight: 700; color: #EF4444;">
                        {{ \App\Models\Vendors::where('status', 'rejected')->count() }}
                    </div>
                    <div style="font-size: 11px; color: #9CA3AF; font-weight: 500;">Rejected</div>
                </div>
            </div>

            <!-- Divider -->
            <hr class="divider">

            <!-- Actions -->


            <p style="text-align: center; font-size: 13px; color: #9CA3AF; margin-top: 8px;">
                <i>This registration requires your approval before the vendor can start using the platform.</i>
            </p>

        </div>

        <!-- ========================================== -->
        <!-- FOOTER -->
        <!-- ========================================== -->
        <div class="footer">
            <div style="display: flex; justify-content: center; gap: 6px; flex-wrap: wrap; margin-bottom: 8px;">
                <a href="#" style="color: #6B7280; text-decoration: none; font-size: 13px;">Help Center</a>
                <span style="color: #D1D5DB;">•</span>
                <a href="#" style="color: #6B7280; text-decoration: none; font-size: 13px;">Privacy Policy</a>
                <span style="color: #D1D5DB;">•</span>
                <a href="#" style="color: #6B7280; text-decoration: none; font-size: 13px;">Terms of Service</a>
            </div>

            <div class="social-icons">
                <a href="#" title="Facebook">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="#" title="Instagram">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1112.324 0 6.162 6.162 0 01-12.324 0zM12 16a4 4 0 110-8 4 4 0 010 8zm4.965-10.405a1.44 1.44 0 112.881.001 1.44 1.44 0 01-2.881-.001z"/></svg>
                </a>
                <a href="#" title="Twitter">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="#" title="YouTube">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
            </div>

            <p class="copyright">
                &copy; {{ date('Y') }} FoodHUB. All rights reserved.
            </p>
        </div>

    </div>

</body>
</html>
