import React from "react";

export const handlePositionCategory = (formData, handleChangeValue) => {
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
