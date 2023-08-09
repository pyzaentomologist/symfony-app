import React from "react";
import axios from "axios";

export default function Navbar() {
  const getCookieValue = (name) => {
    const cookies = document.cookie.split("; ");
    for (const cookie of cookies) {
      const [cookieName, cookieValue] = cookie.split("=");
      if (cookieName === name) {
        return cookieValue;
      }
    }
    return null;
  };

  const phpSessId = getCookieValue("foo");
  const deleteCookie = (name) => {
    document.cookie =
      name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  };

  const handleLogoutClick = async () => {
    deleteCookie("foo");
    try {
      await axios.post("/logout");
    } catch (error) {
      console.error("Błąd podczas wylogowywania:", error);
    }
  };
  if (phpSessId === "1") {
    return (
      <ul className="text-1xl">
        {/* <li>{user.username}</li> */}
        <li>
          <div>
            <a href={`/admin`} className="m-8">
              Admin
            </a>
          </div>
        </li>
        <li>
          <div>
            <a href="#" className="m-8" onClick={handleLogoutClick}>
              Logout
            </a>
          </div>
        </li>
      </ul>
    );
  } else {
    return (
      <ul className="text-1xl">
        <li>
          <div>
            <a href={`/login`} className="m-8">
              Login
            </a>
          </div>
        </li>
        <li>
          <div>
            <a href={`/register`} className="m-8">
              Register
            </a>
          </div>
        </li>
      </ul>
    );
  }
}
