<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<!-- Registration -->
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    if (empty($_POST["fname"])) {
        $flag = false;
        echo "Fill First Name <br>";
    }
    if (empty($_POST["lname"])) {
        $flag = false;
        echo "Fill Last Name <br>";
    }
    if (empty($_POST["ftname"])) {
        $flag = false;
        echo "Fill Father's Name <br>";
    }
    if (empty($_POST["mtname"])) {
        $flag = false;
        echo "Fill Mother's Name <br>";
    }
    if (empty($_POST["gender"])) {
        $flag = false;
        echo "Select Gender <br>";
    }
    if (empty($_POST["dob"])) {
        $flag = false;
        echo "Fill Date of Birth <br>";
    }
    if (empty($_POST["email"])) {
        $flag = false;
        echo "Fill Email<br>";
    }
    if (empty($_POST["phone"])) {
        $flag = false;
        echo "Fill Phone/Mobile <br>";
    }
    if (empty($_POST["web"])) {
        $flag = false;
        echo "Fill Website URL <br>";
    }
    if (empty($_POST["address"])) {
        $flag = false;
        echo "Fill Present Address <br>";
    }
    if (empty($_POST["username"])) {
        $flag = false;
        echo "Fill Username <br>";
    }
    if (empty($_POST["password"])) {
        $flag = false;
        echo "Fill Password <br>";
    }

    if ($flag == true) {
        $fname = extractRaw($_POST["fname"]);
        $lname = extractRaw($_POST["lname"]);
        $ftname = extractRaw($_POST["ftname"]);
        $mtname = extractRaw($_POST["mtname"]);
        $gender = extractRaw($_POST["gender"]);
        $dob = extractRaw($_POST["dob"]);
        $bog = extractRaw($_POST["bog"]);
        $email = extractRaw($_POST["email"]);
        $phone = extractRaw($_POST["phone"]);
        $web = extractRaw($_POST["web"]);
        $address = extractRaw($_POST["address"]);
        $username = extractRaw($_POST["username"]);
        $password = extractRaw($_POST["password"]);

        echo '
        <div align="center">
        <br><h1>Registration</h1=><br><br>
        <table>
            <td></td>
            <td>
        <fieldset>
        <legend><b>General Information:</b></legend>
        <table>
            <tr>
                <td>
                    <label for="fname"><b>First Name</b></label>
                </td>
                <td>
                    <b>: </b>' . $fname . '
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lname"><b>Last Name</b></label>
                </td>
                <td>
                    <b>: </b>' . $lname . '
                </td>
            </tr>
            <tr>
                <td>
                    <label for="ftname"><b>Fathers Name</b></label>
                </td>
                <td>
                    <b>: </b>' . $ftname . '
                </td>
            </tr>
            <tr>
                <td>
                    <label for="mtname"><b>Mothers Name</b></label>
                </td>
                <td>
                    <b>: </b>' . $mtname . '
                </td>
            </tr>
            <tr>
                <td>
                    <label for="male"><b>Gender</b></label>
                </td>
                <td>
                    <b>: </b>' . $gender . '
                </td>
            </tr>
            <tr>
                <td>
                    <label for="dob"><b>Date of Birth</b></label>
                </td>
                <td>
                    <b>: </b>' . $dob . '
                </td>
            </tr>
            <tr>
                <td>
                    <label for="bog"><b>Blood Group</b></label>
                </td>
                <td>
                    <b>: </b>' . $bog . '
                </td>
            </tr>
        </table>
    </fieldset>
    <fieldset>
            <legend><b>Contact Information:</b></legend>
            <table>
                <tr>
                    <td>
                        <label for="email"><b>Email</b></label>
                    </td>
                    <td>
                        <b>: </b>' . $email . '
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="phone"><b>Phone/Mobile</b></label>
                    </td>
                    <td>
                        <b>: </b>' . $phone . '
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="web"><b>Website</b></label>
                    </td>
                    <td>
                        <b>: </b>' . $web . '
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="address"><b>Present Address</b></label>
                    </td>
                    <td>
                        <b>: </b>' . $address . '
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend><b>Account Information:</b></legend>
            <table>
                <tr>
                    <td>
                        <label for="username"><b>Username</b></label>
                    </td>
                    <td>
                        <b>: </b>' . $username . '
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password"><b>Password</b></label>
                    </td>
                    <td>
                        <b>: </b>' . $password . '
                    </td>
                </tr>
            </table>
        </fieldset>
                <p>Already have an account? Login <a href="task1Login.html">here</a></p>
            </td>
            <td>
            </td>
        </table>
        </div>
        ';

    }
}
function extractRaw($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>