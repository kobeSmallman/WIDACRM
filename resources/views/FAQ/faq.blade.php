{{-- faq.blade.php --}}
<x-layout>
<!-- FAQ 1 - Bootstrap Brain Component -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<section class="bg-light py-3 py-md-5">
  <div class="container">
    <div class="row gy-5 gy-lg-0 align-items-lg-center">
      <div class="col-12 col-lg-6">
        <img class="img-fluid rounded" loading="lazy" src="{{ asset('dist/img/image.png') }}" alt="How can we help you?">
      </div>
      <div class="col-12 col-lg-6">
        <div class="row justify-content-xl-end">
          <div class="col-12 col-xl-11">
            <h2 class="h1 mb-3">How can we help you?</h2>
            <p class="lead fs-4 text-secondary mb-5">We hope you have found an answer to your question. If you need any help, please search your query on our Support Center or contact us via email.</p>
            <div class="accordion accordion-flush" id="accordionExample">
            <input type="text" id="searchInput" class="form-control mb-3" onkeyup="searchFAQ()" placeholder="Search for questions...">
              {{-- Custom Questions --}}
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingNewUser">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNewUser" aria-expanded="false" aria-controls="collapseNewUser">
                    How can I add a new user or employee?
                  </button>
                </h2>
                <div id="collapseNewUser" class="accordion-collapse collapse" aria-labelledby="headingNewUser" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    To add a new user or employee, log in to your administrative account, navigate to the "System Users" section in the side navigation, then choose "Add New Employee." Fill out the form with the required information, and upon completion, select "Create Employee."
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingNewClient">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNewClient" aria-expanded="false" aria-controls="collapseNewClient">
                    How do I add a new client or customer?
                  </button>
                </h2>
                <div id="collapseNewClient" class="accordion-collapse collapse" aria-labelledby="headingNewClient" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Upon logging in, navigate to the "Clients" tab in the side navigation. Click on "Add New Client," fill out the form, and confirm the entry once completed.
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingNewOrder">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNewOrder" aria-expanded="false" aria-controls="collapseNewOrder">
                    What's the process for adding a new order?
                  </button>
                </h2>
                <div id="collapseNewOrder" class="accordion-collapse collapse" aria-labelledby="headingNewOrder" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Head to the "Orders" tab on the side navigation, then select "Add New Order." Fill in the necessary details in the table provided and submit the order by pressing "Submit Order."
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingPermissions">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePermissions" aria-expanded="false" aria-controls="collapsePermissions">
                    How can I check the permissions assigned to each employee for different pages?
                  </button>
                </h2>
                <div id="collapsePermissions" class="accordion-collapse collapse" aria-labelledby="headingPermissions" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Navigate to the "Permissions" tab on the side navigation. Select the page you're interested in, and from the dropdown menu on the right side of the table, review the permissions assigned to each employee for that specific page.
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingUserProfile">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUserProfile" aria-expanded="false" aria-controls="collapseUserProfile">
                    How do I access my user profile to update information such as name and profile picture?
                  </button>
                </h2>
                <div id="collapseUserProfile" class="accordion-collapse collapse" aria-labelledby="headingUserProfile" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Click on your name located at the top right corner of the header. From the dropdown menu, select "Edit Profile" to access and update your user profile.
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingLogout">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLogout" aria-expanded="false" aria-controls="collapseLogout">
                    What's the procedure for logging out?
                  </button>
                </h2>
                <div id="collapseLogout" class="accordion-collapse collapse" aria-labelledby="headingLogout" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    To log out, click on your user profile at the top right corner. From the dropdown menu that appears, scroll down to find the logout button and select it to log out of your account.
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://unpkg.com/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function searchFAQ() {
    var input, filter, accordion, items, item, i, text;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    accordion = document.getElementById("accordionExample");
    items = accordion.getElementsByClassName("accordion-item");

    for (i = 0; i < items.length; i++) {
        item = items[i];
        text = item.textContent || item.innerText;
        if (text.toUpperCase().indexOf(filter) > -1) {
            items[i].style.display = "";
        } else {
            items[i].style.display = "none";
        }
    }
}
</script>

</x-layout>
