import React, { useState } from "react";
import List from "../components/List";
import { phpSessId, deleteCookie } from "../utils/get-cookie";
import axios from "axios";

export default function UsersContainer(props) {
  let usersList = [...props.users];
  const [users, setUsers] = useState(usersList);
  console.log(users);
  const handleDelete = async (userId, username) => {
    try {
      const response = await axios.delete(`/admin/delete/${userId}`, userId, {
        headers: {
          "Content-Type": "application/json",
        },
      });
      if (phpSessId === username) {
        deleteCookie("foo");
        await axios.post("/logout");
      }
      if (response.status === 204) {
        usersList = users.filter((user) => user.id !== userId);
        setUsers(usersList);
      }
      return;
    } catch (error) {
      console.log(error);
      window.location.href = "/login";
    }
  };

  return (
    <div>
      {users.length ? (
        <List users={users} handleDelete={handleDelete} />
      ) : (
        <h2 className="text-3xl">Brak użytkowników!</h2>
      )}
    </div>
  );
}
