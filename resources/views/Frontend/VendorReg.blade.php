<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
  <style>
@layer components {
    /* Container */
    .container-custom {
        @apply max-w-7xl mx-auto px-4 sm:px-6 lg:px-8;
    }

    /* Buttons */
    .btn-primary {
        @apply bg-primary hover:bg-primary-dark text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 hover:shadow-lg;
    }

    .btn-secondary {
        @apply bg-secondary hover:bg-secondary-light text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 hover:shadow-lg;
    }

    .btn-outline {
        @apply border-2 border-primary text-primary hover:bg-primary hover:text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200;
    }

    .btn-ghost {
        @apply text-secondary hover:text-primary font-semibold py-2.5 px-4 rounded-lg transition-all duration-200;
    }

    /* Cards */
    .card {
        @apply bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300;
    }

    .card-hover {
        @apply hover:shadow-2xl hover:-translate-y-1 transition-all duration-300;
    }

    /* Inputs */
    .input-primary {
        @apply w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 outline-none;
    }

    .input-search {
        @apply w-full px-5 py-3.5 rounded-full border-2 border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 outline-none bg-white;
    }

    /* Badges */
    .badge-primary {
        @apply bg-primary/10 text-primary font-medium px-3 py-1 rounded-full text-sm;
    }

    .badge-success {
        @apply bg-green-100 text-green-700 font-medium px-3 py-1 rounded-full text-sm;
    }

    .badge-warning {
        @apply bg-yellow-100 text-yellow-700 font-medium px-3 py-1 rounded-full text-sm;
    }

    /* Section Headers */
    .section-title {
        @apply text-3xl md:text-4xl font-bold text-secondary mb-3;
    }

    .section-subtitle {
        @apply text-lg text-gray-600 max-w-2xl mx-auto;
    }

    /* Hero Section */
    .hero-gradient {
        background: linear-gradient(135deg, #E85D04 0%, #DC2F02 50%, #6A4E3A 100%);
    }

    /* Shadows */
    .shadow-soft {
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .shadow-medium {
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }

    /* Backgrounds */
    .bg-primary-bg {
        background-color: #FFF3E0;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #E85D04 0%, #DC2F02 100%);
    }
}

  </style>
  <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
 <section class="min-h-screen py-8 md:py-16 bg-gradient-to-br from-gray-50 via-white to-primary-bg">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-block p-4 bg-gradient-primary rounded-2xl shadow-xl mb-4">
                <span class="text-5xl">🏨</span>
            </div>
            <h1 class="text-3xl md:text-4xl font-heading font-bold text-secondary">
                Register Your Hotel
            </h1>
            <p class="text-gray-500 mt-2 max-w-md mx-auto">
                Join FoodHUB  and start attracting more guests to your hotel
            </p>
        </div>

        <!-- Registration Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

            <!-- Progress Bar -->
            <div class="px-6 pt-6 pb-4 border-b border-gray-100 bg-gray-50/50">
                <div class="flex items-center justify-between max-w-md mx-auto">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm shadow-md">
                            1
                        </div>
                        <span class="text-xs text-primary font-medium mt-1">Account</span>
                    </div>
                    <div class="flex-1 h-1.5 bg-primary/30 mx-2">
                        <div class="h-full w-2/4 bg-primary rounded-full"></div>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-sm">
                            2
                        </div>
                        <span class="text-xs text-gray-400 mt-1">Details</span>
                    </div>
                    <div class="flex-1 h-1.5 bg-gray-200 mx-2"></div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-sm">
                            3
                        </div>
                        <span class="text-xs text-gray-400 mt-1">Complete</span>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('vendor.register.submit') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
                @csrf

                <!-- ============================================ -->
                <!-- PERSONAL INFORMATION -->
                <!-- ============================================ -->
                <div class="mb-8">
                    <h3 class="text-lg font-heading font-semibold text-secondary flex items-center gap-2 mb-4">
                        <span class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                            <i class="fas fa-user text-sm"></i>
                        </span>
                        Personal Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Full Name -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 outline-none @error('name') border-red-500 ring-red-500/20 @enderror"
                                       placeholder="John Doe"
                                       required>
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 outline-none @error('email') border-red-500 ring-red-500/20 @enderror"
                                       placeholder="john@example.com"
                                       required>
                            </div>
                            <p class="text-xs text-gray-400 mt-1.5 flex items-center gap-1">
                                <i class="fas fa-info-circle"></i> We'll send verification email to this address
                            </p>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Contact Number -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Contact Number <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input type="tel"
                                       name="contact_no"
                                       value="{{ old('contact_no') }}"
                                       class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 outline-none @error('contact_no') border-red-500 ring-red-500/20 @enderror"
                                       placeholder="+977 9800000000"
                                       required>
                            </div>
                            @error('contact_no')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- ============================================ -->
                <!-- BUSINESS INFORMATION -->
                <!-- ============================================ -->
                <div class="mb-8">
                    <h3 class="text-lg font-heading font-semibold text-secondary flex items-center gap-2 mb-4">
                        <span class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                            <i class="fas fa-hotel text-sm"></i>
                        </span>
                        Hotel Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Company Name -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Hotel/Company Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-building"></i>
                                </span>
                                <input type="text"
                                       name="company_name"
                                       value="{{ old('company_name') }}"
                                       class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 outline-none @error('company_name') border-red-500 ring-red-500/20 @enderror"
                                       placeholder="Grand Plaza Hotel"
                                       required>
                            </div>
                            @error('company_name')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Registration Number -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Registration Number <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-id-card"></i>
                                </span>
                                <input type="text"
                                       name="reg_no"
                                       value="{{ old('reg_no') }}"
                                       class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 outline-none @error('reg_no') border-red-500 ring-red-500/20 @enderror"
                                       placeholder="ABC-1234-5678"
                                       required>
                            </div>
                            <p class="text-xs text-gray-400 mt-1.5 flex items-center gap-1">
                                <i class="fas fa-info-circle"></i> Your business registration or PAN number
                            </p>
                            @error('reg_no')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Address
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-3 text-gray-400">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <input type="text"
                                       name="address"
                                       value="{{ old('address') }}"
                                       class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 outline-none"
                                       placeholder="123 Main Street">
                            </div>
                            @error('address')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- City -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                City
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-city"></i>
                                </span>
                                <input type="text"
                                       name="city"
                                       value="{{ old('city') }}"
                                       class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 outline-none"
                                       placeholder="Kathmandu">
                            </div>
                            @error('city')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- ============================================ -->
                <!-- LOGO UPLOAD -->
                <!-- ============================================ -->
                <div class="mb-8">
                    <h3 class="text-lg font-heading font-semibold text-secondary flex items-center gap-2 mb-4">
                        <span class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                            <i class="fas fa-image text-sm"></i>
                        </span>
                        Hotel Logo
                    </h3>

                    <div class="flex flex-col sm:flex-row items-center gap-6 p-6 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 hover:border-primary transition-all duration-200">
                        <!-- Preview -->
                        <div id="logo-preview" class="w-32 h-32 rounded-xl bg-white border-2 border-gray-200 flex items-center justify-center overflow-hidden shadow-sm flex-shrink-0">
                            <div class="text-center">
                                <i class="fas fa-building text-4xl text-gray-300"></i>
                                <p class="text-xs text-gray-400 mt-1">No logo</p>
                            </div>
                        </div>

                        <div class="flex-1 text-center sm:text-left">
                            <p class="text-sm font-medium text-gray-700">Upload your hotel logo</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG or SVG (Max 2MB)</p>
                            <p class="text-xs text-gray-400">Recommended: 200×200 pixels</p>

                            <div class="flex flex-wrap gap-3 mt-3">
                                <label for="logo-input" class="btn-primary py-2.5 px-6 text-sm cursor-pointer inline-block">
                                    <i class="fas fa-upload mr-2"></i> Choose Logo
                                </label>
                                <button type="button" onclick="removeLogo()" class="border border-gray-300 text-gray-600 hover:border-red-500 hover:text-red-500 font-medium py-2.5 px-6 rounded-lg transition-all duration-200 text-sm">
                                    <i class="fas fa-times mr-2"></i> Remove
                                </button>
                            </div>
                            <input type="file"
                                   name="logo"
                                   id="logo-input"
                                   class="hidden"
                                   accept="image/*">
                            @error('logo')
                                <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- ============================================ -->
                <!-- TERMS & SUBMIT -->
                <!-- ============================================ -->
                <div class="space-y-6">
                    <!-- Terms -->
                    <div class="flex items-start gap-3 p-4 bg-primary-bg rounded-xl border border-primary/20">
                        <input type="checkbox"
                               name="terms"
                               id="terms"
                               class="mt-1 w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary transition-all duration-200 @error('terms') border-red-500 ring-red-500/20 @enderror"
                               required>
                        <div>
                            <label for="terms" class="text-sm text-gray-700">
                                I agree to the
                                <a href="#" class="text-primary hover:text-primary-dark font-medium hover:underline">Terms of Service</a>
                                and
                                <a href="#" class="text-primary hover:text-primary-dark font-medium hover:underline">Privacy Policy</a>
                                <span class="text-red-500">*</span>
                            </label>
                            @error('terms')
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-medium text-blue-800">What happens next?</p>
                                <ul class="text-sm text-blue-700 space-y-1 mt-1">
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-green-500"></i>
                                        Your registration will be reviewed by our team
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-envelope text-blue-500"></i>
                                        You'll receive a confirmation email with login credentials
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-clock text-yellow-500"></i>
                                        Approval usually takes 24-48 hours
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-primary w-full py-4 text-lg flex items-center justify-center gap-3 group ">
                        <i class="text-blue-500 fas fa-paper-plane group-hover:translate-x-1 transition-transform duration-200 "></i>
                        Submit Registration
                        <span class="text-xs opacity-75 group-hover:opacity-100 transition-all duration-200">(Free)</span>
                    </button>

                    <!-- Login Link -->
                    <p class="text-center text-sm text-gray-500">
                        Already have an account?
                        <a href="" class="text-primary hover:text-primary-dark font-medium hover:underline">
                            Sign In
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Features -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
            <div class="bg-white rounded-xl shadow-soft p-4 text-center">
                <div class="w-12 h-12 bg-primary-bg rounded-full flex items-center justify-center text-primary mx-auto mb-2">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <h4 class="font-semibold text-secondary text-sm">Reach More Guests</h4>
                <p class="text-xs text-gray-500">Connect with travelers and locals</p>
            </div>
            <div class="bg-white rounded-xl shadow-soft p-4 text-center">
                <div class="w-12 h-12 bg-primary-bg rounded-full flex items-center justify-center text-primary mx-auto mb-2">
                    <i class="fas fa-utensils text-xl"></i>
                </div>
                <h4 class="font-semibold text-secondary text-sm">Showcase Your Menu</h4>
                <p class="text-xs text-gray-500">Display your delicious food items</p>
            </div>
            <div class="bg-white rounded-xl shadow-soft p-4 text-center">
                <div class="w-12 h-12 bg-primary-bg rounded-full flex items-center justify-center text-primary mx-auto mb-2">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
                <h4 class="font-semibold text-secondary text-sm">Grow Your Business</h4>
                <p class="text-xs text-gray-500">Increase visibility and revenue</p>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ============================================
        // LOGO PREVIEW
        // ============================================
        const logoInput = document.getElementById('logo-input');
        const logoPreview = document.getElementById('logo-preview');

        logoInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    logoPreview.innerHTML = `<img src="${e.target.result}" alt="Logo" class="w-full h-full object-cover">`;
                    logoPreview.classList.remove('border-dashed');
                }
                reader.readAsDataURL(file);
            }
        });

        // ============================================
        // REMOVE LOGO
        // ============================================
        window.removeLogo = function() {
            logoInput.value = '';
            logoPreview.innerHTML = `
                <div class="text-center">
                    <i class="fas fa-building text-4xl text-gray-300"></i>
                    <p class="text-xs text-gray-400 mt-1">No logo</p>
                </div>
            `;
        };
    });
</script>

</body>
</html>
