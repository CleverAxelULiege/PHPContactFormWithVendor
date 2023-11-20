<?php

require(__DIR__ . "/vendor/autoload.php");

use App\Validation\Rules\EmailRule;
use App\Validation\Rules\ExcludeIfRule;
use App\Validation\Rules\InListRule;
use App\Validation\Rules\MustBeBeforeOrEqualsDateRule;
use App\Validation\Rules\NullableRule;
use App\Validation\Rules\RequiredIfRule;
use App\Validation\Rules\RequiredRule;
use App\Validation\Validator;

$adult = "adult";
$child = "child";
$rules = [
    "forwho" => [
        new RequiredRule(),
        new InListRule([$adult, $child]),
    ],
    "lname" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $adult),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $child),
    ],
    "fname" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $adult),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $child),
    ],
    "childname" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $child),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $adult),
    ],
    "childfname" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $child),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $adult),
    ],
    "cntname" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $child),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $adult),
    ],
    "phone_number" => [
        new RequiredRule(),
    ],
    "email" => [
        new RequiredRule(),
        new EmailRule(),
    ],
    "addr" => [
        new RequiredRule(),
    ],
    "cpost" => [
        new RequiredRule(),
    ],
    "loc" => [
        new RequiredRule(),
    ],
    "birthdate" => [
        new RequiredRule(),
        new MustBeBeforeOrEqualsDateRule(date("Y/m/d"))
    ],
    "mut" => [
        new RequiredRule(),
    ],
    "natnumber" => [
        new RequiredRule(),
    ],
    "reason" => [
        new RequiredRule(),
    ],
    "orig" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $adult),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $child),
    ],
    "origchild" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $child),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $adult),
    ],
    "syear" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $child),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $adult),
    ],
    "schtype" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $child),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $adult),
    ],
    "message" => [
        new NullableRule(),
    ]
];

$placeholders = [
    "forwho" => "\"pour\"",
    "lname" => "\"nom\"",
    "fname" => "\"prénom\"",
    "childname" => "\"nom de l'enfant\"",
    "childfname" => "\"prénom de l'enfant\"",
    "cntname" => "\"nom du parent à contacter\"",
    "phone_number" => "\"téléphone\"",
    "email" => "\"e-mail\"",
    "addr" => "\"adresse\"",
    "cpost" => "\"code postal\"",
    "loc" => "\"localité\"",
    "birthdate" => "\"date de naissance\"",
    "mut" => "\"mutuelle\"",
    "natnumber" => "\"numéro national\"",
    "reason" => "\"motif de la demande\"",
    "orig" => "\"origine de la demande\"",
    "origchild" => "\"origine de la demande (parents, médecin, psychologue, PMS, ...)\"",
    "syear" => "\"année scolaire\"",
    "schtype" => "\"type d'enseignement\"",
    "message" => "\"message\""
];

$validator = new Validator($rules, $_POST, $placeholders);
$validator
//je peux lui dire de directement retourner à cette URL si la validation rate avec les "vieilles" données ainsi que les messages d'erreurs stockées dans des cookies.
->redirectTo("/index.php")
->validate(); 

$validator
->redirectTo("/index.php")
//si j'ai des données "sensibles", je peux lui spécifier les vieilles données à ne pas renvoyer dans les cookies grâce à cette méthode
->setKeysToRemoveFromDataWhenRedirecting(["natnumber", "mut"]) 
->validate();


