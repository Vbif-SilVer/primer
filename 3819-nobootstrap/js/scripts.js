//ОБРАБОТКА ОШИБОК

//собираем коллекцию инпутов с классом validate
let inputs = document.querySelectorAll('.validate'); 

//перебираем все элементы коллекции и вешаем на них обработчики событий 
inputs.forEach(item=>{
	item.addEventListener("invalid", check);
	item.addEventListener("input", reset);
});

//выделяем все инпуты с неверно введенными данными и выводим сообщение
function check(event){
	this.classList.remove("border-blue");
	this.classList.add("border-red");
	event.preventDefault(); //отключение стандарных действий браузера
	document.getElementById('validateAlert').innerText="Данные не введены, или введены в неправильном формате!";
	document.getElementById('validateAlert').style.display="block";
	setTimeout("document.getElementById('validateAlert').style.transform='scale(1)';", 100);
}

//возвращает стандартный вид инпутов при вводе данных
function reset(){
	this.classList.remove("border-red");
	this.classList.add("border-blue");
	document.getElementById('validateAlert').style.transform='scale(0)';
	setTimeout("document.getElementById('validateAlert').style.display='none';", 500);	
}

//собираем коллекцию сообщение с классом alert и вешаем на них функцию по клику
document.querySelectorAll('.alert').forEach(item => item.addEventListener('click', removeBlock)); 

//функция, убирающая сообщение об ошибке по клику
function removeBlock() {
	let block = this;
	block.style.transform = 'scale(0)';
	if (document.getElementById('message')) {
		setTimeout("document.getElementById('message').style.display='none';", 500);
	}
	if (document.getElementById('validateAlert')) {
		setTimeout("document.getElementById('validateAlert').style.display='none';", 500);
	}
}

//проверка совпадения паролей с выводом сообщения и выделением инпутов
function CheckPassword() {
	if (document.getElementById('password').value !=
		document.getElementById('confirmPass').value) {
		document.querySelectorAll('#password, #confirmPass').forEach(item=>{
			item.classList.remove("border-blue");
			item.classList.add("border-red");
		});
		document.getElementById('validateAlert').innerText = "Введенные пароли не совпадают!";
		document.getElementById('validateAlert').style.display = 'block';
		setTimeout("document.getElementById('validateAlert').style.transform='scale(1)';", 100);
		return false;
	}
	/*let checkbox = document.getElementById('checkbox').checked;
	if (!checkbox) {
		document.getElementById('validateAlert').innerText = "Не отмечено согласие на обработку персональных данных!";
		document.getElementById('validateAlert').style.display = "block";
		setTimeout("document.getElementById('validateAlert').style.transform='scale(1)';", 100);
		event.preventDefault();
		return false;
	}**/
}

//проверка ФИО на латиницу
function fioCheck(){
	let pattern = '^[а-яА-Я\\s]+$';
	let fioValue= getElementById('fio').value;
	if (!fioValue.match(pattern)){
		document.getElementById('validateAlert').style.display="block";
		setTimeout("document.getElementById('validateAlert').style.transform='scale(1)';", 100);
		return false;
	}
}

//функция проверки логина на уникальность
function checkLogin() {
	$.ajax({
		type: "POST", //тоже самое, что и method у форм
		url: "/php/checkLogin.php", //тоже самое, что и action у форм
		data: 'login=' + $("#login").val(), //указываем передаваемое значение
		cache: false, //отключаем кэширование браузером
		success: function(data) { //при успехе вызываем функцию и передаем в нее данные, которые вернул php
			if (data == 0) {
				$("#checkLoginSpan").text('Логин занят!').css('color', 'red');
				$("#register").attr('disabled', 'false');
			} else {
				$("#checkLoginSpan").text('Логин свободен!').css('color', 'green');
				$("#register").removeAttr('disabled');
			}
		}
	});
};

//вешаем обработчики смены фотографий при наведении
document.querySelectorAll('.changePhoto').forEach(item => {
	item.addEventListener('mouseenter', showAfter);
	item.addEventListener('mouseleave', showBefore);
});

//функция показа картинки после
function showAfter() {
	this.firstElementChild.style.display = 'none';
	this.firstElementChild.style.transform = 'scale(0)';
	this.lastElementChild.style.display = 'block';
	setTimeout(() => {
		this.lastElementChild.style.transform = 'scale(1)';
	}, 10);
}

//функция показа картинки до
function showBefore(){
	this.lastElementChild.style.display = 'none';
	this.lastElementChild.style.transform = 'scale(0)';
	this.firstElementChild.style.display = 'block';
	setTimeout(() => {
		this.firstElementChild.style.transform = 'scale(1)';
	}, 10);	
}

//СОРТИРОВКА ПО СТАТУСУ

//показать все
function ShowAll() {
	document.querySelectorAll('.new, .complete, .reject').forEach(elem => elem.style.display = 'block');
}

//показать только новые
function ShowNew() {
	document.querySelectorAll('.new').forEach(elem => elem.style.display = 'block');
	document.querySelectorAll('.complete, .reject').forEach(elem => elem.style.display = 'none');
}

//показать только выполненные
function ShowComplete() {
	document.querySelectorAll('.complete').forEach(elem => elem.style.display = 'block');
	document.querySelectorAll('.new, .reject').forEach(elem => elem.style.display = 'none');
}

//показать только на расмотрении
function ShowReject() {
	document.querySelectorAll('.reject').forEach(elem => elem.style.display = 'block');
	document.querySelectorAll('.complete, .new').forEach(elem => elem.style.display = 'none');
}



