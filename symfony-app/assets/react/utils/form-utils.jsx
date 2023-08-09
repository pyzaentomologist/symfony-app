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
            checked={formData[categoriesNames.firstStage[index]]}
            className="w-full mt-6 px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
          />
          <input
            name={categoriesNames.secondStage[index]}
            type="text"
            placeholder={categories.secondStage[index]}
            onChange={handleChangeValue}
            checked={formData[categoriesNames.secondStage[index]]}
            className="w-full mt-6 px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
          />
          <label
            htmlFor={categoriesNames.thirdStage[index]}
            className="flex mt-6 items-center space-x-2"
          >
            {categories.thirdStage[index]}
            <input
              name={categoriesNames.thirdStage[index]}
              type="checkbox"
              onChange={handleChangeValue}
              checked={formData[categoriesNames.thirdStage[index]]}
              className="form-checkbox mx-4 text-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-600"
            />
          </label>
        </div>
      );
    } else return;
  });
};
