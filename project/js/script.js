let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');
};

window.onscroll = () =>{
   menu.classList.remove('fa-times');
   navbar.classList.remove('active');
};


document.addEventListener("DOMContentLoaded", function() {
    // Initialize swiper for the carousel
    var swiper = new Swiper(".swiper-wrapper", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        autoplay: {
            delay: 3000, // 1 second delay between slides
            disableOnInteraction: false,
        },
    });
});


var swiper = new Swiper(".reviews-slider", {
   grabCursor:true,
   loop:true,
   autoHeight:true,
   spaceBetween: 20,
   breakpoints: {
      0: {
        slidesPerView: 1,
      },
      700: {
        slidesPerView: 2,
      },
      1000: {
        slidesPerView: 3,
      },
   },
});

let loadMoreBtn = document.querySelector('.packages .load-more .btn');
let currentItem = 3;

loadMoreBtn.onclick = () =>{
   let boxes = [...document.querySelectorAll('.packages .box-container .box')];
   for (var i = currentItem; i < currentItem + 3; i++){
      boxes[i].style.display = 'inline-block';
   };
   currentItem += 3;
   if(currentItem >= boxes.length){
      loadMoreBtn.style.display = 'none';
   }
}

// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {
   // Get all select elements
   const selects = document.querySelectorAll('.content select');

   // Iterate over each select element
   selects.forEach(select => {
      // Add change event listener to each select
      select.addEventListener('change', function () {
         const selectedOption = this.value; // Get the selected option
         const box = this.closest('.box'); // Get the parent box element

         // Filter images based on the selected option
         filterImages(selectedOption, box);
      });
   });

   // Function to filter images
   function filterImages(option, box) {
      // Get all images inside the current box
      const images = box.querySelectorAll('.image img');

      // Iterate over each image
      images.forEach(image => {
         // Show or hide images based on the selected option
         if (option === 'all' || imageMatchesFilter(image, option)) {
            image.parentElement.style.display = 'block';
         } else {
            image.parentElement.style.display = 'none';
         }
      });
   }

   // Function to check if an image matches the selected filter option
   function imageMatchesFilter(image, option) {
      // Implement your logic here to determine if the image matches the filter option
      // For example, you might check if the image has a certain attribute or class
      // Return true if the image matches the filter option, otherwise return false
      // Example:
      // return image.dataset.filter === option;
   }
});



// JavaScript
document.addEventListener("DOMContentLoaded", function () {
   // Handle dropdown change
   const dropdowns = document.querySelectorAll(".dropdown select");
   dropdowns.forEach(function (dropdown) {
       dropdown.addEventListener("change", function () {
           window.location = this.value;
       });
   });
});


const form = document.querySelector('form');

form.addEventListener('submit', (e) => {
  e.preventDefault();
  const selectedDate = document.querySelector('#dates').value;
  console.log(`Selected date: ${selectedDate}`);
  // Add code here to handle the selected date
});