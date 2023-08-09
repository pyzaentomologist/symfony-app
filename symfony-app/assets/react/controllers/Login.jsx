import React from "react";

import Form from "../components/LoginForm";

export default function (props) {
  const cleanLastUsername = props.last_username.replace(/^"|"$/g, "");
  return <Form lastUsername={cleanLastUsername} />;
}
