const formSubmit = document.getElementById('form-submit');
const guitarList = document.querySelector('.display-toggle');
const guitarTitleInput = document.querySelector('.guitar-form-title');
const insertForm = document.getElementById('insert__form');
const guitarDescriptionInput = document.querySelector('.guitar-form-description');
const guitarFileInput = document.getElementById('input__file');
const guitarTypeInput = document.querySelector('.guitar-form-select-list');
const guitarListBody = document.querySelector('.inserted-guitars-body');
const guitarReset = document.getElementById('form-reset')

let guitarListArray = [];

formSubmit.addEventListener('click', (e) => {
  e.preventDefault();
  const guitarTitle = guitarTitleInput.value;
  const guitarDescription = guitarDescriptionInput.value;
  const guitarFile = guitarFileInput.files[0];
  const guitarType = guitarTypeInput.value;

  if (!guitarTitle || !guitarDescription || !guitarFile || !guitarType) {
    alert('форма заполнена неправильно!');
    return;
  }

  const guitar = {
    title: guitarTitle,
    description: guitarDescription,
    file: guitarFile.name,
    type: guitarType
  }

  guitarList.style.display='block'
  guitarListArray.push(guitar);

  guitarListBody.replaceChildren();

  guitarListArray.forEach((item, index)=> {
    guitarListBody.append(createRow({id: index+1, ...item}));
  });
  resetForm();
})

guitarReset.addEventListener('click', (e) => {
  guitarListArray = [];
  resetForm();
  guitarListBody.replaceChildren();
  guitarList.style.display='none';
});

const createRow = (guitar) => {
  const guitarHtmlItem = document.createElement('tr')

  const tdNomer = document.createElement('td');
  tdNomer.innerText=guitar.id;

  const tdTitle = document.createElement('td');
  tdTitle.innerText=guitar.title;

  const tdDescription = document.createElement('td');
  tdDescription.innerText=guitar.description;

  const tdType = document.createElement('td');
  tdType.innerText=guitar.type;

  const tdFile = document.createElement('td');
  tdFile.innerText=guitar.file;

  guitarHtmlItem.append(tdNomer, tdTitle, tdDescription,tdType, tdFile);
  return guitarHtmlItem;
}

const resetForm = () => {
  insertForm.reset();
  const field = document.getElementById('input__file');
  const label = field.nextElementSibling;
  label.querySelector('.file-btn-label').innerText = 'Загурзить изображение';
}

