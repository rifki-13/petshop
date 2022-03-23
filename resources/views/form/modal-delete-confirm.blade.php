<div class="fixed z-10 inset-0 overflow-y-auto" style="display: none" x-show="openModalKonfirmasi">
    <div
        class="
            flex
            items-end
            justify-center
            min-h-screen
            pt-4
            px-4
            pb-20
            text-center
            sm:block sm:p-0
         ">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-50"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
        <transition name="pop" appear>
            <div class="
                  inline-block
                  align-bottom
                  bg-white
                  rounded-lg
                  text-left
                  overflow-hidden
                  shadow-xl
                  transform
                  transition-all
                  sm:my-8 sm:align-middle sm:max-w-lg sm:w-full
               "
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div
                    class="
                     bg-white
                     dark:bg-gray-800
                     px-4
                     pt-5
                     pb-4
                     sm:p-6 sm:pb-4
                  ">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="
                           mx-auto
                           flex-shrink-0 flex
                           items-center
                           justify-center
                           h-12
                           w-12
                           rounded-full
                           bg-red-100
                           sm:mx-0 sm:h-10 sm:w-10
                        ">
                            <!-- Heroicon name: exclamation -->
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="
                              text-lg
                              leading-6
                              font-medium
                              text-gray-900
                              dark:text-white
                           "
                                id="modal-headline">
                                Konfirmasi
                            </h3>
                            <div class="mt-2">
                                <p x-text="data_title"
                                    class="
                                 text-sm
                                 leading-5
                                 text-gray-500
                                 dark:text-gray-300
                              ">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <form x-bind:action="action_url" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <div
                        class="
                         bg-gray-50
                         dark:bg-gray-700
                         px-4
                         py-3
                         sm:px-6 sm:flex sm:flex-row-reverse
                      ">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button type="submit"
                                class="
                               inline-flex
                               justify-center
                               w-full
                               rounded
                               border border-transparent
                               px-8
                               py-1
                               bg-red-600
                               text-xs
                               leading-6
                               text-white
                               shadow-sm
                               hover:bg-red-900
                               focus:outline-none
                               focus:border-red-900
                               focus:shadow-outline-red
                               transition
                               ease-in-out
                               duration-150
                            ">
                                Ya
                            </button>
                        </span>
                        <span
                            class="
                            mt-3
                            flex
                            w-full
                            rounded-md
                            shadow-sm
                            sm:mt-0 sm:w-auto
                         ">
                            <button @click="openModalKonfirmasi = false" type="button"
                                class="
                               inline-flex
                               justify-center
                               w-full
                               rounded-md
                               border border-gray-300
                               px-6
                               py-1
                               bg-white
                               text-base
                               leading-6
                               font-medium
                               text-gray-700
                               shadow-sm
                               hover:text-gray-500
                               focus:outline-none
                               focus:border-blue-300
                               focus:shadow-outline-blue
                               transition
                               ease-in-out
                               duration-150
                               sm:text-sm sm:leading-5
                            ">
                                Batal
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </transition>
    </div>
</div>
