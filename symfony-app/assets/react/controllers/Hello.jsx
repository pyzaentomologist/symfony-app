import React from "react";

export default function (props) {
  const users = props.users;
  return users.map((user, index) => {
    return (
      <h2 class="text-3xl" key={index}>
        Hello {user}
      </h2>
    );
  });
}
