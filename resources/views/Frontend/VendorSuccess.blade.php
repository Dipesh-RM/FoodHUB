<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css','resources/js/app.js')
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
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

            <!-- Success Header -->
            <div class="relative bg-gradient-primary px-6 py-12 text-center">
                <div class="absolute inset-0 bg-[url('/images/hero-pattern.png')] bg-repeat opacity-5"></div>
                <div class="relative">
                    <!-- Animated Checkmark -->
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg animate-pulse">
                        <i class="fas fa-check-circle text-5xl text-green-500"></i>
                    </div>
                    <h2 class="text-3xl font-heading font-bold text-white">Registration Submitted! 🎉</h2>
                    <p class="text-white/80 mt-2">Thank you for registering your hotel</p>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6 md:p-8">

                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-6">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                            <p class="text-green-700 text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Status Card -->
                <div class="bg-primary-bg rounded-xl p-6 border border-primary/20 mb-6">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-3 h-3 rounded-full bg-yellow-500 animate-pulse"></div>
                        <span class="font-semibold text-secondary">Status: Pending Approval</span>
                    </div>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            Registration received successfully
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-clock text-yellow-500"></i>
                            Under review by our team
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-envelope text-primary"></i>
                            Check your email for login credentials
                        </li>
                    </ul>
                </div>

                <!-- Next Steps -->
                <div class="mb-6">
                    <h4 class="font-heading font-semibold text-secondary mb-4 flex items-center gap-2">
                        <i class="fas fa-list-check text-primary"></i>
                        What happens next?
                    </h4>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-200">
                            <span class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold flex-shrink-0">1</span>
                            <div>
                                <p class="font-medium text-secondary text-sm">Review Process</p>
                                <p class="text-xs text-gray-500">Our team will review your registration within 24-48 hours.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-200">
                            <span class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold flex-shrink-0">2</span>
                            <div>
                                <p class="font-medium text-secondary text-sm">Email Notification</p>
                                <p class="text-xs text-gray-500">You'll receive an email once your hotel is approved or if we need more information.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-200">
                            <span class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold flex-shrink-0">3</span>
                            <div>
                                <p class="font-medium text-secondary text-sm">Start Managing</p>
                                <p class="text-xs text-gray-500">Once approved, you can log in to manage your menu, view orders, and more.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="" class="btn-primary py-3 px-8 text-center flex-1">
                        <i class="fas fa-tachometer-alt mr-2"></i> Go to Dashboard
                    </a>
                    <a href="" class="btn-outline py-3 px-8 text-center flex-1">
                        <i class="fas fa-home mr-2"></i> Back to Home
                    </a>
                </div>

                <!-- Help Text -->
                <p class="text-center text-xs text-gray-400 mt-6">
                    <i class="fas fa-question-circle mr-1"></i>
                    Need help?
                    <a href="" class="text-primary hover:underline">Contact Support</a>
                </p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-3 gap-4 mt-6">
            <div class="bg-white rounded-xl shadow-soft p-3 text-center">
                <p class="text-2xl font-heading font-bold text-primary">50+</p>
                <p class="text-xs text-gray-500">Hotels Registered</p>
            </div>
            <div class="bg-white rounded-xl shadow-soft p-3 text-center">
                <p class="text-2xl font-heading font-bold text-primary">200+</p>
                <p class="text-xs text-gray-500">Menu Items</p>
            </div>
            <div class="bg-white rounded-xl shadow-soft p-3 text-center">
                <p class="text-2xl font-heading font-bold text-primary">4.8</p>
                <p class="text-xs text-gray-500">Avg. Rating</p>
            </div>
        </div>
    </div>
</section>
</body>
</html>
