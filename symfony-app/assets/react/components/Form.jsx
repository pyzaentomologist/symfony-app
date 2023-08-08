import React, { useState } from "react";
import axios from "axios";
import { handlePositionCategory } from "../utils/form-utils";

export default function () {
  const [formData, setFormData] = useState({
    firstName: "",
    lastName: "",
    email: "",
    password: "",
    describeUser: "",
    position: "",
    testingSystems: "",
    reportingSystems: "",
    seleniumKnowledge: false,
    ideEnvironments: "",
    programmingLanguages: "",
    mysqlKnowledge: false,
    projectMethodologies: "",
    scrumKnowledge: false,
  });
  const [checkPassword, setCheckPassword] = useState({
    check_password: "",
  });
  const [submittedEmail, setSubmittedEmail] = useState("");
  const [passwordsMatch, setPasswordsMatch] = useState(true);

  const [sendData, setSendData] = useState(false);

  const [serverError, setServerError] = useState({
    errorExist: false,
    message: "",
  });

  const handleCheckPassword = () => {
    return formData.password === checkPassword.check_password;
  };

  const handleChangeSecondPassword = (e) => {
    const { name, value } = e.target;
    setCheckPassword((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  const matchPassword = () => {
    return (
      !passwordsMatch && (
        <p className="text-red-600">Hasła nie są identyczne!</p>
      )
    );
  };

  const showResponseData = () => {
    if (sendData && !serverError.errorExist) {
      return (
        <h3>
          Użytkowniku, na podany adress e-mail: {submittedEmail} został wysłany
          mail z potwierdzeniem rejestracji oraz dane do logowania
        </h3>
      );
    } else if (serverError.errorExist) {
      return <h3>{serverError.message}</h3>;
    }
  };

  const handleChangeValue = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData((prevData) =>
      type === "checkbox"
        ? { ...prevData, [name]: checked }
        : { ...prevData, [name]: value }
    );
  };

  const handleSubmitForm = async (e) => {
    e.preventDefault();
    if (!handleCheckPassword()) {
      setPasswordsMatch(false);
      return;
    } else setPasswordsMatch(true);

    try {
      const response = await axios.post("/register", formData, {
        headers: {
          "Content-Type": "application/json",
        },
      });
      if (response.data) {
        setSendData(true);
        setServerError({
          errorExist: false,
          message: "",
        });
        setSubmittedEmail(formData.email);
        return;
      } else {
        setSendData(false);
        setServerError({
          errorExist: true,
          message: "Coś poszło nie tak, spróbuj ponownie później",
        });
      }
    } catch (error) {
      const message = error.response.data.errors;
      console.log(message);
      setServerError({ errorExist: true, message: message });
      if (message === "There is already an account with this email") {
        setServerError({
          errorExist: true,
          message: "Wskazany adres mailowy jest zajęty",
        });
      }
    }
  };

  return (
    <form onSubmit={handleSubmitForm}>
      <input
        name="firstName"
        type="text"
        placeholder="Imię"
        onChange={handleChangeValue}
        required
      />
      <input
        name="lastName"
        type="text"
        placeholder="Nazwisko"
        onChange={handleChangeValue}
        required
      />
      <input
        name="email"
        type="email"
        placeholder="Adress e-mail"
        onChange={handleChangeValue}
        required
      />
      <input
        name="password"
        type="password"
        placeholder="Hasło"
        onChange={handleChangeValue}
        required
      />
      <input
        name="check_password"
        type="password"
        placeholder="Powtórz hasło"
        onChange={handleChangeSecondPassword}
        required
      />
      {matchPassword()}
      <textarea
        name="describeUser"
        id="describeUser"
        maxLength="255"
        placeholder="Opis (maks. 255 znaków)"
        onChange={handleChangeValue}
      ></textarea>
      <select
        name="position"
        id="position"
        onChange={handleChangeValue}
        required
        value={formData.position}
      >
        <option value="" disabled defaultValue>
          Wybierz stanowisko
        </option>
        <option value="tester">tester</option>
        <option value="developer">developer</option>
        <option value="project manager">project manager</option>
      </select>
      {handlePositionCategory(formData, handleChangeValue)}

      <button type="submit">Utwórz konto</button>
      {showResponseData()}
    </form>
  );
}
