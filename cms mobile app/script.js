// document.addEventListener('DOMContentLoaded', function() {
//     const categories = document.querySelectorAll('.category');

//     categories.forEach(function(category) {
//         category.addEventListener('click', function(event) {
//             event.preventDefault(); // Prevent default behavior of anchor elements

//             // Toggle active class for the clicked category
//             category.classList.toggle('active');

//             // Toggle display of the corresponding sub-menu
//             const subMenu = category.querySelector('.sub-menu');
//             if (subMenu) {
//                 subMenu.style.display = category.classList.contains('active') ? 'block' : 'none';
//             }
//         });
//          // Prevent propagation of click events on sub-menu links
//          const subMenuLinks = category.querySelectorAll('.sub-menu a');
//          subMenuLinks.forEach(function(link) {
//              link.addEventListener('click', function(event) {
//                  event.stopPropagation();
//              });
//          });
//     });
// });
