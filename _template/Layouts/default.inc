<?php

/*
 * Copyright (C) 2018, Yurij Kadirov.
 * All rights are reserved.
 * Licensed under Apache License 2.0 with additional restrictions.
 *
 * @Author: Yurij Kadirov
 * @Website: https://sirkadirov.com/
 * @Email: admin@sirkadirov.com
 * @Repo: https://github.com/SirkadirovTeam/SimplePM_Server
 */

include _SPM_template_ . "Parts/header.inc";

?>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?=_SPM_?>"><strong>Simple</strong>PM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?=_SPM_?>">Головна</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Користувачі
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?=_SPM_?>index.php/users/rating/">Рейтинг</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item disabled" href="">Користувачі онлайн</a>
                        <a class="dropdown-item disabled" href="">Дні народження</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Архів задач
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?=_SPM_?>index.php/problems/archive/">Архів задач</a>
                        <a class="dropdown-item" href="<?=_SPM_?>index.php/problems/difficult/">Відкладені задачі</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item disabled" href="">Черга перевірки</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="">Змагання</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Привіт, <?=Security::getCurrentSession()["user_info"]->getUserInfo()["username"]?>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?=_SPM_?>index.php/users/profile/">Моя сторінка</a>
                        <a class="dropdown-item" href="<?=_SPM_?>index.php/users/edit/">Редагувати сторінку</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item disabled" href="">Про систему</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?=_SPM_?>index.php?cmd=logout">Вийти з системи</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="jumbotron text-white bg-dark">
        <h4 class="lead">$(title)</h4>
    </div>

</div>

<main role="main" class="container">
$(content)
</main>

<footer class="footer container">
    <p>Powered by <a href="https://spm.sirkadirov.com/">SimplePM</a> - Copyright &copy; 2016-2018, <a href="https://sirkadirov.com/">Sirkadirov Team</a>. Усі права захищено.</p>
</footer>

<?php include _SPM_template_ . "Parts/footer.inc"; ?>