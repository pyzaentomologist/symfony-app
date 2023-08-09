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
    <form
      className="max-w-md mx-auto p-4 bg-white rounded-lg shadow-md"
      onSubmit={handleSubmitForm}
    >
      <input
        name="_username"
        id="_username"
        type="email"
        placeholder="Adress e-mail"
        onChange={handleChangeValue}
        value={formData._username}
        required
        className="w-full px-4 py-2 mb-2 border rounded-md focus:outline-none focus:border-blue-500"
      />
      <input
        name="_password"
        id="_password"
        type="password"
        placeholder="Hasło"
        onChange={handleChangeValue}
        required
        className="w-full px-4 py-2 mb-2 border rounded-md focus:outline-none focus:border-blue-500"
      />

      {showResponseData()}
      <button
        className="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none"
        type="submit"
      >
        Zaloguj się
      </button>
    </form>
  );
}
