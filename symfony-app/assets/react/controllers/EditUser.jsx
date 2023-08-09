import React from "react";

import Form from "../components/EditUserForm";

export default function (props) {
  console.log(props);
  return <Form userData={props.userData} />;
}
