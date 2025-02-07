<?php $location_index = ".."; include("../components/header.php")?>
<body class="dark:bg-gray-900">

    <main>
        <?php $no_button = true; $location_index = ".."; require("../components/user/navbar.php")?>
    
        <center>
            <div class="upload-data">
                <div class="max-w-2xl pt-8 md:px-0 px-5">
    
                    <form action="../backend/graph.php" method="post" enctype="multipart/form-data">
    
                        <input type="hidden" name="token" value="<?php echo $token?>">

                        <!-- name_graph -->
                        <div class="grid gap-6 mb-6 text-left">
                            <div>
                                <label for="name_graph" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Graph Name</label>
                                <input name="name_graph" type="text" id="name_graph" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Graph Water Level" required />
                            </div>
                        </div>
    
                        <!-- variable_one_name -->
                        <div class="grid gap-6 mb-6 text-left">
                            <div>
                                <label for="variable_one_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Variable 1 Name</label>
                                <input name="variable_one_name" type="text" id="variable_one_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Water Level" required />
                            </div>
                        </div>
        
                        <!-- variable_one_unit -->
                        <div class="grid gap-6 mb-6 text-left">
                            <div>
                                <label for="variable_one_unit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Variable 1 Unit</label>
                                <input name="variable_one_unit" type="text" id="variable_one_unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="m" required />
                            </div>
                        </div>
        
                        <div class="grid gap-6 mb-6 text-left">
                            <div>
                                <label for="variable_two_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Variable 2 Name</label>
                                <input name="variable_two_name" type="text" id="variable_two_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Time (Hour)" required />
                            </div>
                        </div>
        
                        <div class="grid gap-6 mb-6 text-left">
                            <div>
                                <labe for="variable_two_unit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Variable 2 Unit</label>
                                <input name="variable_two_unit" type="text" id="varible_two_unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="h" required />
                            </div>
                        </div>

                        <!-- embedding_dimension_value_graph -->
                        <div class="grid gap-6 mb-6 text-left">
                            <div>
                                <labe for="embedding_dimension_value_graph" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Embedding Dimension Value (m)</label>
                                <input name="embedding_dimension_value_graph" type="text" id="embedding_dimension_value_graph" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1" required />
                            </div>
                        </div>
        
                        <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file" accept=".csv" required>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">.TXT (MAX. 100MB).</p><br>
                            
                        <?php 
                            $id_user = htmlspecialchars($user_value['id_user']);
                            $user_sql = $connect->prepare("SELECT * FROM users WHERE id_user = ?");
                            $user_sql->execute([$id_user]);
                            $user = $user_sql->fetch(PDO::FETCH_ASSOC);

                            if($user['type_user'] == 1){$max_val = $plan1;}
                            elseif($user['type_user'] == 2){$max_val = $plan2;}

                            if($user['generated_val_user'] >= $max_val){
                                ?>
                                
                                <!-- Modal toggle -->
                                <button data-modal-target="progress-modal" data-modal-toggle="progress-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                Submit
                                </button>

                                <!-- Main modal -->
                                <div id="progress-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full text-left">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="progress-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5">
                                                <svg class="w-10 h-10 text-gray-400 dark:text-gray-500 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                                    <path d="M8 5.625c4.418 0 8-1.063 8-2.375S12.418.875 8 .875 0 1.938 0 3.25s3.582 2.375 8 2.375Zm0 13.5c4.963 0 8-1.538 8-2.375v-4.019c-.052.029-.112.054-.165.082a8.08 8.08 0 0 1-.745.353c-.193.081-.394.158-.6.231l-.189.067c-2.04.628-4.165.936-6.3.911a20.601 20.601 0 0 1-6.3-.911l-.189-.067a10.719 10.719 0 0 1-.852-.34 8.08 8.08 0 0 1-.493-.244c-.053-.028-.113-.053-.165-.082v4.019C0 17.587 3.037 19.125 8 19.125Zm7.09-12.709c-.193.081-.394.158-.6.231l-.189.067a20.6 20.6 0 0 1-6.3.911 20.6 20.6 0 0 1-6.3-.911l-.189-.067a10.719 10.719 0 0 1-.852-.34 8.08 8.08 0 0 1-.493-.244C.112 6.035.052 6.01 0 5.981V10c0 .837 3.037 2.375 8 2.375s8-1.538 8-2.375V5.981c-.052.029-.112.054-.165.082a8.08 8.08 0 0 1-.745.353Z"/>
                                                </svg>
                                                <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white"><span class="bg-green-100 text-green-800 font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Free Plan</span></h3>
                                                <p class="text-gray-500 dark:text-gray-400 mb-6">The free plan allows you to upload up to 5 files. Please kindly upgrade to upload more files.<p>
                                                <div class="flex justify-between mb-1 text-gray-500 dark:text-gray-400">
                                                    <span class="text-base font-normal">My Usage</span>
                                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">You have used <?php echo $max_val . " / " . $max_val?> Uploads </span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-600">
                                                    <div class="bg-red-500 h-2.5 rounded-full" style="width: 100%"></div>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="flex items-center mt-6 space-x-4 rtl:space-x-reverse">
                                                    <a href="./payment-plan.php">
                                                        <button data-modal-hide="progress-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upgrade to PRO</button>
                                                    </a>
                                                    <button data-modal-hide="progress-modal" type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <?php 
                            }
                            else{
                                ?>

                                <input type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="upload_data" value="Submit">

                                <?php
                            }
                        ?>
                    </form>
                </div>
    
    
            </div>
        </center>
    
        <?php require("../components/footer.php");?>

    </main>

    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>
</html>