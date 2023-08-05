import React from "react";
import UserList from "../components/List";

export default function (props) {
  const users = props.users;
  console.log(props.users);
  if (users.length) {
    return <UserList users={users} />;
  } else {
    return <h2 className="text-3xl">Brak użytkowników!</h2>;
  }
}
