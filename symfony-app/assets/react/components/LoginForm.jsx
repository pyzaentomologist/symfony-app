import React, { useState } from "react";
import axios from "axios";

export default function Form({ lastUsername }) {
  const [formData, setFormData] = useState({
    _username: lastUsername,
    _password: "",
  });
  const [serverError, setServerError] = useState(false);
  const handleChangeValue = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  const showResponseData = () => {
    if (serverError) {
      return <h3>Niepoprawny login lub hasło</h3>;
    }
  };

  const handleSubmitForm = async (e) => {
    e.preventDefault();

    try {
      const requestData = new FormData();
      requestData.append("_username", formData._username);
      requestData.append("_password", formData._password);
      const response = await axios.post("/login", requestData);

      console.log(response);
      setServerError(false);
      document.cookie = `foo=${formData._username}`;
      window.location.href = "/admin";
      return;
    } catch (error) {
      console.log(error);
      setServerError(true);
    }
  };

  return (
    <form onSubmit={handleSubmitForm}>
      <input
        name="_username"
        id="_username"
        type="email"
        placeholder="Adress e-mail"
        onChange={handleChangeValue}
        value={formData._username}
        required
      />
      <input
        name="_password"
        id="_password"
        type="password"
        placeholder="Hasło"
        onChange={handleChangeValue}
        required
      />

      {showResponseData()}
      <button type="submit">Login</button>
    </form>
  );
}