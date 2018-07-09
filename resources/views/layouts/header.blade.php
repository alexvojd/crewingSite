
<header class="container">


	<div class="navbar bg-dark navbar-fixed-top" id="navbarNavDropdown">
		<div class="col-md-5">
			<ul class="nav justify-content-center">
				<li class="nav-item active"><a href="/mainpage" class="btn">Главная</a></li>
				<li class="nav-item"><a href="/vacancy" class="btn">Вакансии</a></li>
				<li class="nav-item"><a href="/resume" class="btn">Резюме</a></li>
				<li class="nav-item"><a href="/contacts" class="btn">Контакты</a></li>
			</ul>
		</div>

			<ul class="nav right">
			@if(Session::get('user_group')!='Гость' && Session::get('user_group') != null)
				<li class="nav-item right">
				 	<a href='/profile' class="btn">Личный кабинет</a>
				 </li>
				<li class="nav-item right">
				 	<a href='/logout' class="btn">Выйти</a> 
				 </li>
			@else
				<li class="nav-item right">
					<a href="/authorization" class="btn">Авторизация</a>
				</li>
				<li class="nav-item dropdown right">
					<a href="#" class="btn nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Регистрация</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		         			<a class="dropdown-item" href="/register/company">Компания</a>
		          			<a class="dropdown-item" href="/register/sailor">Моряк</a>
		          		</div>
				</li>

			@endif
		</ul>
		</div>

</header>
@if (Session::get('user_group')=='Sailors')
	<nav class="d-none d-md-block bg-light sidebar" style="margin-top: 62px; position: fixed; min-width: 240px; max-width: 240px;z-index: 2; border: 1px solid #ccc;">
	          <div class="sidebar-sticky">
	            <ul class="nav flex-column">
	              <li class="nav-item">
	                <a class="nav-link" href="/profile">
	                  <span data-feather="home"></span>
	                  Персональные данные <span class="sr-only"></span>
	                </a>
	              </li>
	              <li class="nav-item">
	                <a class="nav-link" href="/profile/addresume">
	                  <span data-feather="file"></span>
	                  Добавить резюме
	                </a>
	              </li>
	              <li class="nav-item">
	                <a class="nav-link" href="/profile/addexperience">
	                  <span data-feather="file"></span>
	                  Добавить опыт
	                </a>
	              </li>
	              <li class="nav-item">
	                <a class="nav-link" href="/profile/manageresume">
	                  <span data-feather="shopping-cart"></span>
	                  Управление резюме
	                </a>
	              </li>
	              <li class="nav-item">
	                <a class="nav-link" href="/profile/user_request">
	                  <span data-feather="users"></span>
	                  Запрос помощи
	                </a>
	              </li>
	            </ul>
	          </div>
	</nav>
@endif
@if (Session::get('user_group')=='Companies')
	<nav class="d-none d-md-block bg-light sidebar" style="margin-top: 62px; position: fixed; min-width: 240px; max-width: 240px;z-index: 2; border: 1px solid #ccc;">
	          <div class="sidebar-sticky">
	            <ul class="nav flex-column">
	              <li class="nav-item">
	                <a class="nav-link" href="/profile">
	                  <span data-feather="home"></span>
	                  Данные компании <span class="sr-only"></span>
	                </a>
	              </li>
	              <li class="nav-item">
	                <a class="nav-link" href="/profile/addvacancy">
	                  <span data-feather="file"></span>
	                  Добавить вакансию
	                </a>
	              </li>
	              <li class="nav-item">
	                <a class="nav-link" href="/profile/deletavacancies">
	                  <span data-feather="file"></span>
	                  Удаление вакансий
	                </a>
	              </li>
	              <li class="nav-item">
	                <a class="nav-link" href="/profile/user_request">
	                  <span data-feather="users"></span>
	                  Запрос помощи
	                </a>
	              </li>
	            </ul>
	          </div>
	</nav>
@endif
@if (Session::get('user_group')=='Managers')
	<nav class="d-none d-md-block bg-light sidebar" style="margin-top: 62px; position: fixed; min-width: 240px; max-width: 240px; z-index: 2; border: 1px solid #ccc;">
	          <div class="sidebar-sticky">
	            <ul class="nav flex-column">
	              <li class="nav-item">
	                <a class="nav-link" href="/profile">
	                  <span data-feather="home"></span>
	                  Данные менеджера <span class="sr-only"></span>
	                </a>
	              </li>
	              <li class="nav-item">
	                <a class="nav-link" href="/register/sailor">
	                  <span data-feather="file"></span>
	                  Добавить моряка
	                </a>
	              </li>
	              <li class="nav-item">
	                <a class="nav-link" href="/profile/addexperience">
	                  <span data-feather="file"></span>
	                  Добавить опыт моряку
	                </a>
	              </li>
	              <li class="nav-item">
	                <a class="nav-link" href="/register/company">
	                  <span data-feather="users"></span>
	                  Добавить компанию
	                </a>
	              </li>
	               <li class="nav-item">
	                <a class="nav-link" href="/manager/search_resumes">
	                  <span data-feather="users"></span>
	                  Поиск моряков
	                </a>
	              </li>
	               <li class="nav-item">
	                <a class="nav-link" href="/manager/search_vacancies">
	                  <span data-feather="users"></span>
	                  Поиск вакансий
	                </a>
	              </li>
	              </li>
	               <li class="nav-item">
	                <a class="nav-link" href="/manager/user_requests">
	                  <span data-feather="users"></span>
	                  Запросы пользователей
	                </a>
	              </li>
	            </ul>
	          </div>
	</nav>
@endif