<!--Name: Shashwat Kumar
    StudentId: 000790494
    I certify that this is my original work. -->

    <?php 

class User {
    private $email_ad;
    private $username;
    private $password;
    private $verified;

    function __construct($email_ad,$username,$password,$verified){
        $this->email_ad = $email_ad;
        $this->username = $username;
        $this->password = $password;
        $this->verified = $verified;
    }
     /**
      * Returns a string representation of the user object as a list item
      */
    function toListItem(){
       return "<span style = 'display:inline-block; font-size:16px; width:350px; padding:30px; vertical-align:middle;margin-left:120px;'>$this->email_ad</span> 
       <span style = 'display:inline-block; width:100px; font-size:16px; padding:10px; vertical-align:middle;margin-left:10px;'>$this->username</span> 
        <span style = 'display:inline-block; width:100px; font-size:16px; padding:10px; vertical-align:middle;margin-left:10px;'>$this->password</span> 
        <span style = 'display:inline-block; width:100px; font-size:16px; padding:10px; vertical-align:middle;'>$this->verified </span>";
    }

    /**
     * Returns the email address
     */
    function getEmailID(){
        return $this->email_ad;
    }
}
?>