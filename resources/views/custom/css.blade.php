body {
    background: #{{ $color2 }};
}

.navbar-light .navbar-brand {
    color: #{{ $color3 }};
}

a {
    color: #{{ $color2 }};
}

a:hover,
a:focus,
a:active {
    color: #{{ $color3 }};
}

.nav-shop {
    background:  #{{ $color1 }} !important;
}

.btn-primary,
.btn-primary[disabled],
.btn-primary:active,
.btn-primary:focus {
    background-color: #{{ $color4 }} !important;
    border-color: #{{ $color4 }} !important;
}

.text-primary {
    color: #{{ $color4 }} !important;
}

.btn-primary:hover {
    border-color: #{{ $color4 }};
}

.btn-gardient {
    background: #{{ $color6 }};
    background: -moz-linear-gradient(45deg, #{{ $color6 }} 0%, #{{ $color5 }} 100%);
    background: -webkit-linear-gradient(45deg, #{{ $color6 }} 0%,#{{ $color5 }} 100%);
    background: linear-gradient(45deg, #{{ $color6 }} 0%,#{{ $color5 }} 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#{{ $color6 }}', endColorstr='#{{ $color5 }}',GradientType=1 );
}

.ticket-reply.ticket-reply-answer {
    background: #{{ $color7 }};
}

.ticket-reply.ticket-reply-answer .ticket-reply-span {
    border-color: #{{ $color8 }};
}

.btn-primary,
.btn-gardient {
    background: #{{ $color9 }};
    background: -moz-linear-gradient(45deg, #{{ $color9 }} 0%, #{{ $color3 }} 100%);
    background: -webkit-linear-gradient(45deg, #{{ $color9 }} 0%,#{{ $color3 }} 100%);
    background: linear-gradient(45deg, #{{ $color9 }} 0%,#{{ $color3 }} 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#{{ $color9 }}', endColorstr='#{{ $color3 }}',GradientType=1 );
}

.card-header {
    background: #{{ $color9 }};
    background: -moz-linear-gradient(45deg, #{{ $color9 }} 0%, #{{ $color3 }} 100%);
    background: -webkit-linear-gradient(45deg, #{{ $color9 }} 0%,#{{ $color3 }} 100%);
    background: linear-gradient(45deg, #{{ $color9 }} 0%,#{{ $color3 }} 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#{{ $color9 }}', endColorstr='#{{ $color3 }}',GradientType=1 );
}