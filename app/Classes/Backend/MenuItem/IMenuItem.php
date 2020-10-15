<?php

namespace App\Classes\Backend\MenuItem;

    interface IMenuItem
    {
        public function getPosition() : int;

        public function setPosition(int $position) : MenuItem;

        public function getParent() : string;

        public function setParent($parent) : MenuItem;

        public function getName() : string;

        public function setName(string $name) : MenuItem;

        public function getIcon() : string;

        public function setIcon(string $icon) : MenuItem;

        public function getText() : string;

        public function setText(string $text) : MenuItem;

        public function getRedirect() : string;

        public function setRedirect(string $redirect) : MenuItem;

        public function getRouteName() : string;

        public function setRouteName(string $routeName) : MenuItem;
    }
