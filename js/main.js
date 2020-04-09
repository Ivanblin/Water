var modal = document.querySelector('.modal');
var btn = document.querySelectorAll('.myBtn');
var close = document.querySelector('#close');
for (let i = 0; i < btn.length; i++) {
  btn[i].addEventListener('click', () => {
    modal.style.display = "flex";
  });
}

close.addEventListener('click', () => {
  modal.style.display = "none";
});

window.addEventListener('click', () => {
  if (event.target == modal) {
    modal.style.display = "none";
  }
});

// маска на телефон

var element = document.getElementById('phone');
var maskOptions = {
  mask: '+7(000)000-00-00',
  lazy: true
}
var mask = new IMask(element, maskOptions);