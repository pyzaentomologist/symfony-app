import React, { useState } from "react";
import UserList from "../components/List";
import axios from "axios";

export default function UsersContainer(props) {
  let usersList = [...props.users];
  const [users, setUsers] = useState(usersList);

  const handleDelete = async (userId) => {
    try {
      const response = await axios.delete(`/admin/delete/${userId}`, userId, {
        headers: {
          "Content-Type": "application/json",
        },
      });
      if (response.status === 200) {
        usersList = users.filter((user) => user.id !== userId);
        setUsers(usersList);
      }
      return;
    } catch (error) {
      console.log(error);
    }
  };

  return (
    <div>
      {users.length ? (
        <UserList users={users} handleDelete={handleDelete} />
      ) : (
        <h2 className="text-3xl">Brak użytkowników!</h2>
      )}
    </div>
  );
}
