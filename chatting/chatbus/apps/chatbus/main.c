// C program to implement recursive Binary Search
#include <stdio.h>

// A recursive binary search function. It returns
// location of x in given array arr[l..r] is present,
// otherwise -1



#include <mysql.h>
#include <stdio.h>




int binarySearch(int arr[], int l, int r, int x)
{
	if (r >= l) {
		int mid = l + (r - l) / 2;

		// If the element is present at the middle
		// itself
		if (arr[mid] == x)
			return mid;

		// If element is smaller than mid, then
		// it can only be present in left subarray
		if (arr[mid] > x)
			return binarySearch(arr, l, mid - 1, x);

		// Else the element can only be present
		// in right subarray
		return binarySearch(arr, mid + 1, r, x);
	}

	// We reach here when element is not
	// present in array
	return -1;
}


int test() {
	
	int arr[] = { 2, 3, 4, 10, 40 };
	int n = sizeof(arr) / sizeof(arr[0]);
	int x = 10;
	int result = binarySearch(arr, 0, n - 1, x);
	(result == -1)
		? printf("Element is not present in array")
		: printf("Element is present at index %d", result);
	return 0;
}




int  findUser (const char *username1) {
	
	




	   MYSQL *conn;
   MYSQL_RES *res;
   MYSQL_ROW row;

   char *server = "127.0.0.1";
   char *user = "root";
   char *password = "";
   char *database = "famousme";
   
   conn = mysql_init(NULL);
   
   
   
   /* Connect to database */
   if (!mysql_real_connect(conn, server,
         user, password, database, 0, NULL, 0)) {
      fprintf(stderr, "%s\n", mysql_error(conn));
      return(0);
   }
   
   
   char sql [1000];


        sprintf(sql, "SELECT user_id,  username , email,status, gender FROM Wo_Users WHERE username ='%s'  ", username1);  
		
		//printf("%s",sql);
   /* send SQL query */
   if (mysql_query(conn, sql)) {
      fprintf(stderr, "%s\n", mysql_error(conn));
      return(0);
   }

   res = mysql_use_result(conn);
   
   /* output fields 1 and 2 of each row */
   while ((row = mysql_fetch_row(res)) != NULL)
      printf("%s ,%s ,%s ,%s,%s\n",row[0], row[1], row[2],row[3],row[4]);

   /* Release memory used to store results and close connection */
   mysql_free_result(res);
   mysql_close(conn);
   return 1;
}

int main( int argc , const char *argv[]) {



   if(argc != 1 	)   {
	   
	   findUser(argv[1]);
	   return  1;
	   
   }
   
   return 0;
	   
	   
	

}