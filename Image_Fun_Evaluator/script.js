// Optional: Show file name after selecting image
const imageInput = document.getElementById('image');
imageInput.addEventListener('change', function(){
    if(this.files && this.files[0]){
        const label = document.querySelector('label[for="image"]');
        label.textContent = "Selected file: " + this.files[0].name;
    }
});
