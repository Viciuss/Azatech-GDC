const voltar = document.querySelector("#goBack")

    
voltar.addEventListener("click", () => {
    window.location.href = "../INIT/gdc.php"
})
let currentIndex = 0;
const items = document.querySelectorAll('.carrossel-item');
const totalItems = items.length;

function showItem(index) {
    const carrossel = document.getElementById('carrossel');
    carrossel.style.transform = `translateX(-${index * 100}%)`;
}

document.getElementById('nextBtn').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % totalItems;
    showItem(currentIndex);
});

document.getElementById('prevBtn').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + totalItems) % totalItems;
    showItem(currentIndex);
});



const modal = document.querySelector('.modal-container')

function openModal() {
  modal.classList.add('active')
}

function closeModal() {
  modal.classList.remove('active')
}
