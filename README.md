# lccinter_merged_phpfiles
0. These PHP files are for local usage.
1. These PHP files are used for **merged games** for LCC Interaction System.
2. **Merged games** are the combination of the ultimatum games and the trust games( or called invest games). The player will firstly complete one types games, then play another games. The game order are random and the offers also follow different orders.
3. The PHP files will create a new list containing all the potential offers listed in random order when the player start one type of games. For example, it will create **14investorofferlist.csv** for the trust game( **14proposerofferlist.csv** for the ultimatum game).
4. Each time when the player finish one type of games, the PHP will **delete the related file**. For example, after the ultimatum game, the 14proposerofferlist.csv will be deleted.