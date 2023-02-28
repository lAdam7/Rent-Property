<div
  class="bg-indigo-600 px-4 py-1 text-white flex justify-center items-center sm:px-6 lg:px-8 "
>
  <p class="text-center mr-8 text-sm">
    <b>Hey, {{ auth()->user()->forename }}!</b>
    <br class="sm:hidden" />
    Make sure to verify your email address to protect your account and to unlock landlord contact information and apply as a landord feature.
  </p>

  {{-- <a
    class="mt-4 block rounded-lg bg-white px-5 py-1 text-center text-sm font-medium text-indigo-600 transition hover:bg-white/90 focus:outline-none focus:ring active:text-indigo-500 sm:mt-0"
    href="#"
  >
    Resend Email
  </a> --}}
</div>
