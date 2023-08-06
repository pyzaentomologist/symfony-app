import React from "react";

export default function UserList(props) {
  return (
    <ol className="text-3xl list-decimal list-inside">
      {props.users.map((user, index) => {
        return <li key={index}>{user.email}</li>;
      })}
    </ol>
  );
}
