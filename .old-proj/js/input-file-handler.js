const field = document.getElementById('input__file');
const label = field.nextElementSibling,
  labelVal = label.querySelector('.file-btn-label').innerText;
field.addEventListener('change', (e) => {
  let fileTitle = labelVal;
  const files = e.target?.files;
  if (files && files.length >= 1)
    fileTitle = files[0].name
  label.querySelector('.file-btn-label').innerText = fileTitle;
});