const reg_form = document.getElementById('reg_form');
const editProfile_form = document.getElementById('editProfileForm');
const addTour_form = document.getElementById('addTourForm');
const editPassword_form = document.getElementById('editPasswordForm');
const editTour_form = document.getElementById('editTourForm');
const addBlog_form = document.getElementById('addBlogForm');
const btn_filter = document.getElementById('btn_filter');

const name = document.getElementById('name');
const lastName = document.getElementById('lastName');
const date = document.getElementById('date');
const email = document.getElementById('email');
const login = document.getElementById('login');
const password = document.getElementById('password');
const price = document.getElementById('price');
const capacity = document.getElementById('capacity');
const oldPassword = document.getElementById('old_password');
const newPassword = document.getElementById('new_password');
const newPasswordAgain = document.getElementById('new_password_again');
const minPrice = document.getElementById('min_price');
const maxPrice = document.getElementById('max_price');


if(reg_form != null)
{
    reg_form.addEventListener('submit', (e) => {
        checkInputs(e);
    })
}
else if(editProfile_form !=null)
{
    editProfile_form.addEventListener('submit', (e) =>{
        checkInputs(e);
    })
}
else if(addTour_form !=null)
{
    addTour_form.addEventListener('submit', (e) =>{
        checkInputs(e);
    })
}
else if(editPassword_form !=null)
{
    editPassword_form.addEventListener('submit', (e) =>{
        checkInputs(e);
    })
}
else if(editTour_form !=null)
{
    editTour_form.addEventListener('submit', (e) =>{
        checkInputs(e);
    })
}
else if(addBlog_form !=null)
{
    addBlog_form.addEventListener('submit', (e) =>{
        checkInputs(e);
    })
}
else if(btn_filter !=null)
{
    btn_filter.addEventListener('click', (e) =>{
        checkInputs(e);
    })
}



function checkInputs(e) {

    let nameValue;
    let lastNameValue;
    let emailValue;
    let loginValue;
    let passwordValue;
    let dateValue;
    let today;
    let validMinBirthDate;
    let validMaxBirthDate;
    let validMinTourDate;
    let priceValue;
    let capacityValue;
    let oldPasswordValue;
    let newPasswordValue;
    let newPasswordAgainValue;
    let minPriceValue;
    let maxPriceValue;


    today = new Date();
    validMinBirthDate = new Date(
        today.getFullYear() - 18,
        today.getMonth(),
        today.getDate(),
        today.getHours(),
        today.getMinutes());

    validMaxBirthDate = new Date(
        today.getFullYear() - 110,
        today.getMonth(),
        today.getDate(),
        today.getHours(),
        today.getMinutes());

    validMinTourDate = new Date(
        today.getFullYear(),
        today.getMonth(),
        today.getDate() + 14,
        today.getHours(),
        today.getMinutes());

    if(editPassword_form == null && btn_filter == null)
    {
        //Validácia mena
        nameValue = name.value;
        if (nameValue.length > 255)
        {
            setErrorFor(name, 'Meno je príliš dlhé!', e);
        }
        else
        {
            setSuccessFor(name);
        }
    }


    //Validácia dátumu
    if(reg_form != null || editProfile_form != null)
    {
        dateValue = new Date(date.value);
        if (dateValue > validMinBirthDate)
        {
            setErrorFor(date, 'Musíš mať aspoň 18 rokov!', e);
        }
        else if(dateValue < validMaxBirthDate)
        {
            setErrorFor(date, 'Dátum je príliš starý!', e);
        }
        else
        {
            setSuccessFor(date);
        }
    }
    else if(addTour_form != null || editTour_form != null)
    {
        dateValue = new Date(date.value);
        if (dateValue < validMinTourDate)
        {
            setErrorFor(date, 'Dátum musí byť min. o 2 týždne neskôr', e);
        }
        else
        {
            setSuccessFor(date);
        }
    }

    if(reg_form != null || editProfile_form != null)
    {
        lastNameValue = lastName.value;
        emailValue = email.value;
        loginValue = login.value;


        //Validácia priezviska
        if (lastNameValue.length > 255)
        {
            setErrorFor(lastName, 'Priezvisko je moc dlhé!', e);
        }
        else
        {
            setSuccessFor(lastName);
        }

        //Validácia emailu
        if(!isEmail(emailValue))
        {
            setErrorFor(email, 'Zlý formát emailu!', e);
        }
        else if(emailValue.length > 255)
        {
            setErrorFor(email, 'Email je moc dlhý!', e);
        }
        else
        {
            setSuccessFor(email);
        }

        //Validácia loginu
        if (loginValue.length > 255)
        {
            setErrorFor(login, 'Login je moc dlhý!', e);
        }
        else
        {
            setSuccessFor(login);
        }
        if(reg_form != null)
        {
            passwordValue = password.value;
            //Validácia hesla
            if (passwordValue.length > 255)
            {
                setErrorFor(password, 'Heslo je príliš dlhé', e);

            }
            else if(passwordValue.length < 8 ||
                !passwordValue.match(/[0-9]+/) ||
                !passwordValue.match(/[A-Z]+/) ||
                !passwordValue.match(/[a-z]+/) ||
                !passwordValue.match(/\W+/))
            {
                setErrorFor(password,
                    'Heslo musí mať aspoň 8 znakov!\n' +
                    'Heslo musí obsahovať číslo!\n' +
                    'Heslo musí obsahovať veľké písmeno!\n' +
                    'Heslo musí obsahovať malé písmeno!\n' +
                    'Heslo musí obsahovať špeciálny znak!\n', e);
            }
            else
            {
                setSuccessFor(password);
            }
        }

    }
    else if(addTour_form != null || editTour_form != null)
    {
        priceValue = price.value;
        capacityValue = capacity.value;

        //Validácia ceny
        if (priceValue < 100)
        {
            setErrorFor(price, 'Cena musí mať hodnotu aspoň 100€!', e);
        }
        else
        {
            setSuccessFor(price);
        }

        //Validácia kapacity
        if (capacityValue < 5)
        {
            setErrorFor(capacity, 'Kapacita je príliš nízka! Min. 5', e);
        }
        else
        {
            setSuccessFor(capacity);
        }
    }
    else if(editPassword_form != null)
    {
        oldPasswordValue = oldPassword.value;
        newPasswordValue = newPassword.value;
        newPasswordAgainValue = newPasswordAgain.value;

        if(oldPasswordValue > 255)
        {
            setErrorFor(oldPassword, 'Heslo je príliš dlhé', e);
        }
        else
        {
            setSuccessFor(oldPassword);
        }

        if(newPasswordValue > 255)
        {
            setErrorFor(newPassword, 'Heslo je príliš dlhé', e);
        }
        else if(newPasswordValue.length < 8 ||
            !newPasswordValue.match(/[0-9]+/) ||
            !newPasswordValue.match(/[A-Z]+/) ||
            !newPasswordValue.match(/[a-z]+/) ||
            !newPasswordValue.match(/\W+/))
        {
            setErrorFor(newPassword,
                'Heslo musí mať aspoň 8 znakov!\n' +
                'Heslo musí obsahovať číslo!\n' +
                'Heslo musí obsahovať veľké písmeno!\n' +
                'Heslo musí obsahovať malé písmeno!\n' +
                'Heslo musí obsahovať špeciálny znak!\n', e);
        }
        else if(newPasswordValue !== newPasswordAgainValue)
        {
            setErrorFor(newPassword, 'Zadané nové heslo sa nezhoduje s overením nového hesla!', e);
        }
        else
        {
            setSuccessFor(newPassword);
        }

        if(newPasswordAgainValue > 255)
        {
            setErrorFor(newPasswordAgain, 'Heslo je príliš dlhé', e);
        }
        else if(newPasswordValue !== newPasswordAgainValue)
        {
            setErrorFor(newPasswordAgain, 'Zadané nové heslo sa nezhoduje s overením nového hesla!', e);
        }
        else
        {
            setSuccessFor(newPasswordAgain);
        }

    }
    else if(btn_filter != null)
    {
        minPriceValue = minPrice.value;
        maxPriceValue = maxPrice.value;
        if (parseInt(minPriceValue) > parseInt(maxPriceValue))
        {
            setErrorFor(maxPrice, 'Minimálna cena musí byť menšia než maximálna!', e);
        }
        else
        {
            setSuccessFor(maxPrice);

        }

        if (parseInt(minPriceValue) > parseInt(maxPriceValue))
        {
            setErrorFor(minPrice, 'Minimálna cena musí byť menšia než maximálna!', e);
        }
        else
        {
            setSuccessFor(minPrice);

        }

    }

}

function setSuccessFor(input)
{
    let formInput = input.parentElement;
    let i = formInput.querySelector('i');
    let p = formInput.querySelector('p');
    if(reg_form != null || addTour_form != null || editPassword_form != null || addBlog_form != null)
    {
        p.className = 'visually-hidden errorText';
        i.className = 'mt-2 fas fa-check-circle';
        formInput.className = 'mb-3 form_input success';
    }
    else if(btn_filter != null)
    {
        p.className = 'visually-hidden errorText';
        i.className = 'mt-2 fas fa-check-circle';
        formInput.className = 'col-2 mb-3 form_input success';
    }
    else if(editProfile_form != null || editTour_form != null)
    {
        p.className = 'visually-hidden errorText';
        i.className = 'mt-2 fas fa-check-circle';
        formInput.className = 'col-sm-9 text-secondary form_input success';
    }

}

function setErrorFor(input, message, e)
{
    let formInput = input.parentElement;
    let p = formInput.querySelector('p');
    let i = formInput.querySelector('i');

    if(reg_form != null || addTour_form != null || editPassword_form || addBlog_form != null)
    {
        e.preventDefault();
        p.className = 'errorText';
        formInput.className = 'mb-3 form_input error';
        i.className = 'mt-2 fas fa-exclamation-circle';
        p.innerText = message;
    }
    else if(btn_filter != null)
    {
        e.preventDefault();
        p.className = 'errorText';
        formInput.className = 'col-2 mb-3 form_input error';
        i.className = 'mt-2 fas fa-exclamation-circle';
        p.innerText = message;
    }
    else if(editProfile_form != null || editTour_form != null)
    {
        e.preventDefault();
        p.className = 'errorText2';
        formInput.className = 'col-sm-9 text-secondary form_input error';
        i.className = 'mt-2 fas fa-exclamation-circle';
        p.innerText = message;
    }

}

function isEmail(email)
{
    return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}


