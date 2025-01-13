<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Detail - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body class="bg-base-200 min-h-screen flex flex-col">
    <div class="navbar bg-base-100 shadow-lg">
        <div class="flex-1">
            <a href="index.php" class="btn btn-ghost normal-case text-xl">Perpustakaan</a>
        </div>
        <div class="flex-none">
            <button onclick="window.history.back()" class="btn btn-ghost">Back</button>
        </div>
    </div>

    <div class="flex-grow flex items-center justify-center p-4">
        <div class="card lg:card-side bg-base-100 shadow-2xl max-w-7xl w-full">
            <figure class="lg:w-1/2">
                <img src="https://picsum.photos/seed/1/300/200" alt="Book" class="w-full h-full object-cover" />
            </figure>
            <div class="card-body lg:w-1/2 flex flex-col justify-between ">
                <div>
                    <h2 class="card-title text-4xl mb-6 text-primary">Book Title</h2>
                    <div class="space-y-4">
                        <p class="text-lg"><i class="fas fa-user-edit mr-2"></i><strong>Penulis:</strong> John Doe</p>
                        <p class="text-lg"><i class="fas fa-building mr-2"></i><strong>Penerbit:</strong> Example
                            Publishing</p>
                        <p class="text-lg"><i class="fas fa-calendar-alt mr-2"></i><strong>Tahun Terbit:</strong> 2023
                        </p>
                        <p class="text-lg"><i class="fas fa-barcode mr-2"></i><strong>ISBN:</strong> 978-1234567890</p>
                    </div>
                    <div class="divider"></div>
                    <p class="text-lg">
                        <strong>Deskripsi:</strong> Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit. Sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                        ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
                <div class="card-actions justify-end mt-6">
                    <button class="btn btn-primary btn-lg"
                        onclick="openBorrowModal('Book Title 1', 'https://picsum.photos/seed/1/300/200', '2023')">
                        <i class="fas fa-book-reader mr-2"></i>Pinjam Buku
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Borrow Modal -->
    <input type="checkbox" id="borrow-modal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg" id="modal-book-title"></h3>
            <img id="modal-book-image" src="" alt="Book Cover" class="w-full h-48 object-cover rounded-lg my-4" />
            <p id="modal-book-year" class="mb-4"></p>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Number of books to borrow:</span>
                </label>
                <input type="number" id="borrow-quantity" placeholder="Enter quantity" class="input input-bordered"
                    min="1" max="5" />
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" onclick="borrowBook()">Borrow</button>
                <label for="borrow-modal" class="btn">Close</label>
            </div>
        </div>
    </div>

    <script>
    function openBorrowModal(title, imageUrl, year) {
        document.getElementById("modal-book-title").textContent = title;
        document.getElementById("modal-book-image").src = imageUrl;
        document.getElementById(
            "modal-book-year"
        ).textContent = `Year: ${year}`;
        document.getElementById("borrow-modal").checked = true;
    }

    function borrowBook() {
        const title = document.getElementById("modal-book-title").textContent;
        const quantity = document.getElementById("borrow-quantity").value;
        console.log(`Borrowing ${quantity} copies of "${title}"`);
        // Here you would typically send this data to your backend
        document.getElementById("borrow-modal").checked = false;
    }
    </script>
</body>

</html>