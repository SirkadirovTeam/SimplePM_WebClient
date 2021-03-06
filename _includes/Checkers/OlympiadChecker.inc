<?php

/*
 * ███████╗██╗███╗   ███╗██████╗ ██╗     ███████╗██████╗ ███╗   ███╗
 * ██╔════╝██║████╗ ████║██╔══██╗██║     ██╔════╝██╔══██╗████╗ ████║
 * ███████╗██║██╔████╔██║██████╔╝██║     █████╗  ██████╔╝██╔████╔██║
 * ╚════██║██║██║╚██╔╝██║██╔═══╝ ██║     ██╔══╝  ██╔═══╝ ██║╚██╔╝██║
 * ███████║██║██║ ╚═╝ ██║██║     ███████╗███████╗██║     ██║ ╚═╝ ██║
 * ╚══════╝╚═╝╚═╝     ╚═╝╚═╝     ╚══════╝╚══════╝╚═╝     ╚═╝     ╚═╝
 *
 * SimplePM WebApp is a part of software product "Automated
 * verification system for programming tasks "SimplePM".
 *
 * Copyright (C) 2016-2018 Yurij Kadirov
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 * GNU Affero General Public License applied only to source code of
 * this program. More licensing information hosted on project's website.
 *
 * Visit website for more details: https://spm.sirkadirov.com/
 */

trait OlympiadChecker {

    public static function CheckOlympiadExists() {

        /*
         * Если пользователь авторизирован,
         * а соревнование с указанным идент
         * ификатором не существует,  то мы
         * осуществляем принудительный выхо
         * д пользователя  из  указанного в
         * его профиле соревнования.
         */

        if (UserInfo::IsAuthUser() && Olymp::IsAssociatedWithOlymp())
        {

            /*
             * Получаем уникальный идентификатор
             * ассоциированного соревнования.
             */

            $associated_olymp = Security::getCurrentSession()['user_info']->getUserInfo()['associated_olymp'];

            /*
             * Если соревнование с полученным
             * нами ранее  идентификатором не
             * существует, проделываем необхо
             * димые действия.
             *
             * Существует - значит проводится
             * в данный момент времени.
             */

            if (!Olymp::OlympiadExistsNow($associated_olymp)){

                /*
                 * Производим принудительный выход
                 * из участия в соревновании.
                 */

                Olymp::ExitOlymp();

            }

        }

    }

}