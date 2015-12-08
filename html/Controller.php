<?php
include "id_card_utils.php";
require "config.php";

use Parse\ParseException;
use Parse\ParseObject;

/**
 * Created by PhpStorm.
 * User: allar
 * Date: 6.12.15
 * Time: 11:38
 */
class Controller
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    // Currently example method, no real use of this
    public function clicked()
    {
        $this->user->string = "Updated Data, thanks to MVC and PHP!";
    }

    /**
     * Handles authentication via estonian id-card. Saves data into model User.
     */
    public function auth()
    {
        $ePerson = getEPerson();

        if (!$ePerson) {
//             TODO: Better handling?
            $this->user->string = "ID kaardiga autentimine ebaõnnestus!";
        } else {
            $this->user->lastName = $ePerson[0];
            $this->user->firstName = $ePerson[1];
            $this->user->nationalID = $ePerson[2];
            $this->user->string = "ID kaardiga autentimine õnnestus edukalt!";
            $this->saveUserData($this->user, $this->user->lastName, $this->user->firstName, $this->user->nationalID);

            // Starts user session
            $this->begin_session();
//            $this->signUp($this->user, $this->user->lastName, $this->user->firstName, $this->user->nationalID);
        }
    }

    private function saveUserData($user, $lastName, $firstName, $nationalID)
    {
        $userData = new ParseObject($firstName);

        $userData->set("lastName", $lastName);
        $userData->set("firstName", $firstName);
        $userData->set("nationalID", $nationalID);

        try {
            $userData->save();
            $user->parseMessage = 'New object created with objectId: ' . $userData->getObjectId();
        } catch (ParseException $ex) {
            // Execute any logic that should take place if the save fails.
            // error is a ParseException object with an error code and message.
            $user->parseMessage = 'Failed to create new object, with error message: ' . $ex->getMessage();
        }
    }

    private function begin_session()
    {
        session_start();
        session_regenerate_id();
        $_SESSION['valid'] = 1;
        $this->debug_to_console(md5($_SERVER['HTTP_USER_AGENT']));
        $_SESSION['fingerprint'] = md5($_SERVER['HTTP_USER_AGENT']);
    }

    function debug_to_console($data)
    {

        if (is_array($data))
            $output = "<script>console.log( 'Debug Objects: " . implode(',', $data) . "' );</script>";
        else
            $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

        echo $output;
    }

//    private function signUp($user, $lastName, $firstName, $nationalID)
//    {
//        $parseUser = new ParseUser();
//        $parseUser->set("username", $nationalID);
//        $parseUser->set("password", "default");
//        $parseUser->set("firstName", $firstName);
//        $parseUser->set("lastName", $lastName);
//
//        try {
//            $parseUser->signUp();
//            // Hooray! Let them use the app now.
//            $user->parseMessage = "Hooray! User saved into Parse database.";
//        } catch (ParseException $ex) {
//            // Show the error message somewhere and let the user try again.
//            $user->parseMessage = "Error: " . $ex->getCode() . " " . $ex->getMessage();
//        }
//    }

}