<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body style="
      background-image: url('img/wp1.jpg');
      background-size: cover;
      background-position: center;
    ">
    <div class="hero min-h-screen bg-opacity-80 bg-gray-800">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <!-- Text Section -->
            <div class="text-center lg:text-left text-white max-w-lg">
                <h1 class="text-5xl font-bold">Join Us Today!</h1>
                <p class="py-6 text-lg">
                    Become a part of our library community and unlock thousands of books
                    at your fingertips.
                </p>
            </div>
            <!-- Registration Card -->
            <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-white">
                <div class="card-body">
                    <form action="../response_input.php?modul=auth&fitur=registrasi" method="POST">
                        <!-- Name Field -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Username</span>
                            </label>
                            <div class="relative">
                                <input type="text" placeholder="Enter your full name" name="username_registrasi"
                                    class="input input-bordered w-full pl-10" required />
                                <span class="absolute left-3 top-3 text-gray-400 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 6c4.418 0 8-1.79 8-4H4c0 2.21 3.582 4 8 4z" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="form-control mt-4">
                            <label class="label">
                                <span class="label-text font-semibold">Password</span>
                            </label>
                            <div class="relative">
                                <input type="password" placeholder="Enter your password" name="password_registrasi"
                                    class="input input-bordered w-full pl-10" required />
                                <span class="absolute left-3 top-3 text-gray-400 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 11c1.104.607 2 1.486 2 3 0 2.21-3.582 3-4 3-.418 0-4-.79-4-3 0-1.514.896-2.393 2-3m2-7h.01" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="form-control mt-4">
                            <label class="label">
                                <span class="label-text font-semibold">No Telepon</span>
                            </label>
                            <div class="relative">
                                <input type="text" placeholder="Masukkan No Telepon..." name="no_telp"
                                    class="input input-bordered w-full pl-10" required />
                                <span class="absolute left-3 top-3 text-gray-400 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 11c1.104.607 2 1.486 2 3 0 2.21-3.582 3-4 3-.418 0-4-.79-4-3 0-1.514.896-2.393 2-3m2-7h.01" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <!-- <input type="hidden" name="role_id" value="2"> -->

                        <!-- Register Button -->
                        <div class="form-control mt-6">
                            <button class="btn btn-primary w-full" type="submit">Register</button>
                        </div>
                    </form>

                    <!-- Login Link -->
                    <div class="text-center mt-4">
                        <p class="text-sm">
                            Already have an account? <br />
                            <a href="./loginPage.php" class="link link-primary">Login here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>