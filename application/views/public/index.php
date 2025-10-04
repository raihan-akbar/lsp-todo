<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        body {
            font-family: "Hanken Grotesk", sans-serif;
            font-optical-sizing: auto;

        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 0px;
        }

        ::-webkit-scrollbar-track {
            display: none;
        }
    </style>

    <!-- Color Mode Switcher -->
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('light')
        }
    </script>
    <title><?= $title; ?></title>
</head>

<body class="bg-zinc-200 dark:bg-zinc-800">

    <!-- ! Alert -->
    <?php
    if ($this->session->flashdata("flash_show") == true) {
        $flash_show = "visible";
    } else {
        $flash_show = "invisible";
    }
    ?>
    <div class="fixed inset-x-0 top-0 flex items-end justify-right px-4 py-6 justify-end mt-12 animate__animated animate__fadeInRightBig z-50
    <?= $flash_show; ?>
    ">
        <?php $flash_border = $this->session->flashdata("flash_border"); ?>
        <div class="w-full md:w-full md:max-w-xl shadow-xl rounded-lg py-3 rounded relative bg-zinc-100 dark:bg-zinc-900 border-b-4 <?= $flash_border ?> text-white">
            <div class="p-2">
                <div class="flex items-start">
                    <div class="ml-1 w-0 flex-1 pt-0.5">
                        <div class="flex flex-wrap">
                            <div class="flex">
                                <i class="<?= $this->session->flashdata("flash_style"); ?> p-1"></i>
                            </div>
                            <div class="flex">
                                <p class="text-lg leading-5 font-medium pt-0.5 pl-2 text-zinc-800 dark:text-zinc-200"><?= $this->session->flashdata("flash"); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button class="inline-flex text-zinc-500 hover:text-zinc-400 transition ease-in-out duration-150"
                            onclick="return this.parentNode.parentNode.parentNode.parentNode.remove()">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ! StartContent -->
    <section class="h-screen pt-32 w-full px-8">
        <form action="<?= base_url('main/add_todo') ?>" method="post">
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2">
                <div class="p-4 w-full">
                    <div class="flex rounded-lg h-full bg-indigo-900 dark:bg-indigo-900 p-8 flex-col">
                        <div class="flex items-center mb-3">
                            <input name="title" type="text" placeholder="New Title Here" class="w-full p-2 rounded bg-indigo-50 border">
                        </div>
                        <div class="flex flex-col justify-between flex-grow">
                            <textarea name="desc" type="text" placeholder="Todo Description" class="w-full p-2 rounded bg-indigo-50 border"></textarea>
                        </div>
                        <div class="mt-4">
                            <hr class="border-indigo-200">
                        </div>
                        <div class=" flex flfex-col justify-between flex-grow">
                            <div class="columns-1 pt-4 w-full">
                                <div class="w-full">
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-800 text-zinc-50 font-semibold px-1 py-0.5 rounded">Add Todo List +</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>

        <?php foreach ($getList as $i) { ?>

            <!-- Cards -->
            <div class="p-4 w-full">
                <div class="flex rounded-lg h-full bg-indigo-900 dark:bg-indigo-900 p-8 flex-col">
                    <div class="flex items-center mb-3">
                        <?php
                        if ($i->list_status == 0) {
                            $status = "Unfinish";
                        } else {
                            $status = "Finished";
                        }
                        ?>
                        <h2 class="text-indigo-100 text-lg font-bold"><?= $status ?> | <?= $i->list_title ?></h2>
                    </div>
                    <div class="flex flex-col justify-between flex-grow">
                        <p class="leading-relaxed text-base text-indigo-200">
                            <?= $i->list_desc ?>
                        </p>
                    </div>
                    <div class="mt-4">
                        <hr class="border-indigo-200">
                    </div>
                    <div class=" flex flfex-col justify-between flex-grow">
                        <div class="columns-2 pt-4 w-full">
                            <!-- <div class="w-full">
                                <a href="<?= base_url("Main/finish/") . $i->list_id; ?>" type="button" class="flex w-full h-full text-center text-zinc-50 font-semibold px-1 py-0.5 rounded">Finish List</a>
                            </div> -->
                            <div class="w-full">
                                <button type="button" data-modal-target="update-modal-<?= $i->list_id; ?>" data-modal-toggle="update-modal-<?= $i->list_id; ?>" class="w-full bg-blue-600 hover:bg-blue-800 text-zinc-50 font-semibold px-1 py-0.5 rounded">Update Data</button>

                                <form action="<?= base_url('Main/update') ?>" method="post">
                                    <div id="update-modal-<?= $i->list_id; ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        <?= $i->list_title ?> Update Data
                                                    </h3>
                                                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="remove-modal-<?= $i->list_id; ?>">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5">
                                                    <div class="py-2">
                                                        <input name="list" type="hidden" class="w-full rounded p-2" value="<?= $i->list_id ?>">
                                                        <input name="title" type="text" class="w-full rounded p-2" value="<?= $i->list_title ?>">
                                                    </div>
                                                    <div class="py-2">
                                                        <textarea name="desc" type="text" class="w-full rounded p-2"><?= $i->list_title ?></textarea>
                                                    </div>

                                                    <div class="columns-2">
                                                        <div class="w-full">
                                                            <button type="button" type="submit" class="w-full text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-left dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-hide="update-modal-<?= $i->list_id; ?>">Cancel</button>
                                                        </div>

                                                        <div class="w-full">
                                                            <button type="submit" class="flex w-full h-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save Data</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="w-full">
                                <button type="button" data-modal-target="remove-modal-<?= $i->list_id; ?>" data-modal-toggle="remove-modal-<?= $i->list_id; ?>" class="w-full bg-red-600 hover:bg-red-800 text-zinc-50 font-semibold px-1 py-0.5 rounded">Remove</button>

                                <div id="remove-modal-<?= $i->list_id; ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Are You Sure To Delete Data?
                                                </h3>
                                                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="remove-modal-<?= $i->list_id; ?>">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5">
                                                <p class="text-white text-md pt-2 pb-4 mb-4"><b><?= $i->list_title ?>,</b> Will be deleted permanently</p>

                                                <form class="space-y-4" action="#">
                                                    <div class="columns-2">
                                                        <div class="w-full">
                                                            <button type="button" type="submit" class="w-full text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-left dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-hide="remove-modal-<?= $i->list_id; ?>">Cancel</button>
                                                        </div>

                                                        <div class="w-full">
                                                            <a href="<?= base_url('main/remove/') . $i->list_id ?>" class="flex w-full h-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Yes, I'm Sure!</a>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </section>

    <!-- ! DeadEnd -->

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {

            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

                // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }

        });
    </script>


</body>

</html>