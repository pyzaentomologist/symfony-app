import React, { useState } from "react";
import axios from "axios";
import { handlePositionCategory } from "../utils/form-utils";

export default function (props) {
  const userData = props.userData;
  const [formData, setFormData] = useState({
    firstName: userData.firstName,
    lastName: userData.lastName,
    password: "",
    describeUser: userData.describeUser,
    position: userData.position,
    testingSystems: userData.testingSystems,
    reportingSystems: userData.reportingSystems,
    seleniumKnowledge: userData.seleniumKnowledge,
    ideEnvironments: userData.ideEnvironments,
    programmingLanguages: userData.programmingLanguages,
    mysqlKnowledge: userData.mysqlKnowledge,
    projectMethodologies: userData.projectMethodologies,
    scrumKnowledge: userData.scrumKnowledge,
  });
  const [checkPassword, setCheckPassword] = useState({
    check_password: "",
  });
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
      return <h3>Zmieniono Dane</h3>;
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
      const response = await axios.post(`/admin/${userData.id}`, formData, {
        headers: {
          "Content-Type": "application/json",
        },
      });
      console.log(response, formData);
      if (response.data) {
        setSendData(true);
        setServerError({
          errorExist: false,
          message: "",
        });
      } else {
        setSendData(false);
        setServerError({
          errorExist: true,
          message: "Coś poszło nie tak, spróbuj ponownie później",
        });
      }
    } catch (error) {
      if (error) {
        console.log(error);
        const message = error.response;
        setServerError({ errorExist: true, message: message });
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
        value={formData.firstName}
        required
      />
      <input
        name="lastName"
        type="text"
        placeholder="Nazwisko"
        onChange={handleChangeValue}
        value={formData.lastName}
        required
      />
      <input
        name="password"
        type="password"
        placeholder="Hasło"
        onChange={handleChangeValue}
      />
      <input
        name="check_password"
        type="password"
        placeholder="Powtórz hasło"
        onChange={handleChangeSecondPassword}
      />
      {matchPassword()}
      <textarea
        name="describeUser"
        id="describeUser"
        maxLength="255"
        placeholder="Opis (maks. 255 znaków)"
        onChange={handleChangeValue}
        value={formData.describeUser}
      ></textarea>
      <select
        name="position"
        id="position"
        onChange={handleChangeValue}
        value={formData.position}
        required
      >
        <option value="" disabled defaultValue>
          Wybierz stanowisko
        </option>
        <option value="tester">tester</option>
        <option value="developer">developer</option>
        <option value="project manager">project manager</option>
      </select>
      {handlePositionCategory(formData, handleChangeValue)}

      <button type="submit">Zapisz zmiany</button>
      {showResponseData()}
    </form>
  );
}
