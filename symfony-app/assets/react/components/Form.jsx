import React, { useState } from "react";
import axios from "axios";

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

  const [passwordsMatch, setPasswordsMatch] = useState(true);

  const [sendData, setSendData] = useState(false);

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

  const responseData = () => {
    return (
      sendData && (
        <h3>
          Użytkowniku, na podany adress e-mail: {formData.email} został wysłany
          mail z potwierdzeniem rejestracji oraz dane do logowania
        </h3>
      )
    );
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
      console.log(response.data);
      if (response.data) {
        setSendData(true);
        return;
      } else setSendData(false);
    } catch (error) {
      console.log(error);
    }
  };

  const handlePositionCategory = () => {
    const positions = ["tester", "developer", "project manager"];
    const categoriesNames = {
      firstStage: ["testingSystems", "ideEnvironments", "projectMethodologies"],
      secondStage: [
        "reportingSystems",
        "programmingLanguages",
        "reportingSystems",
      ],
      thirdStage: ["seleniumKnowledge", "mysqlKnowledge", "scrumKnowledge"],
    };
    const categories = {
      firstStage: [
        "systemy testujące",
        "środowiska ide",
        "metodologie prowadzenia projektów",
      ],
      secondStage: [
        "systemy raportowe",
        "języki programowania",
        "systemy raportowe",
      ],
      thirdStage: ["zna selenium", "zna mysql", "zna scrum"],
    };
    return positions.map((position, index) => {
      if (formData.position === position) {
        return (
          <div key={position}>
            <input
              name={categoriesNames.firstStage[index]}
              type="text"
              placeholder={categories.firstStage[index]}
              onChange={handleChangeValue}
            />
            <input
              name={categoriesNames.secondStage[index]}
              type="text"
              placeholder={categories.secondStage[index]}
              onChange={handleChangeValue}
            />
            <label htmlFor={categoriesNames.thirdStage[index]}>
              {categories.thirdStage[index]}
            </label>
            <input
              name={categoriesNames.thirdStage[index]}
              type="checkbox"
              onChange={handleChangeValue}
            />
          </div>
        );
      } else return;
    });
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
      {handlePositionCategory()}

      <button type="submit">Utwórz konto</button>
      {responseData()}
    </form>
  );
}
