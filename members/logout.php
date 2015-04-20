<?php

/*
############################################################################
phpAlumni - A web-based, MySQL-backed alumni management program written in PHP4.
Copyright (C) 2002-2004 Ralf Hetzer

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more members_details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
############################################################################
*/

// log the user out of the member's section and destroys all sessions

session_unset();


//remove the client session
setcookie("check_email", "", time()-1800, "/", "", 0);
setcookie("check_hash", "", time()-1800, "/", "", 0);
setcookie(session_name(),"", time()-1800, "/", "", 0);


//redirect user to the login page
header("Location: ../index.php");
exit;
?>
