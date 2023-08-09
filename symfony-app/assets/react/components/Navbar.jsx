import React from "react";
import axios from "axios";
import { phpSessId, deleteCookie } from "../utils/get-cookie";

export default function Navbar() {
  const handleLogoutClick = async () => {
    deleteCookie("foo");
    try {
      await axios.post("/logout");
      window.location.href = "/login";
    } catch (error) {
      console.error("Błąd podczas wylogowywania:", error);
    }
  };
  if (phpSessId) {
    return (
      <ul className="text-1xl">
        <li>Zalogowany: {phpSessId}</li>
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
