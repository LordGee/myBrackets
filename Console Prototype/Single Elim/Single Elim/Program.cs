using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Single_Elim
{
    class Program
    {
        // Structure for players
        struct Player
        {
            public String playerName;
            public int seed;
            public Boolean set, seedSet;
        }

        // Structure for brackets
        struct Bracket
        {
            private String ph, pa;
            private int sh, sa, sch, sca;
            private Boolean seth, seta;

            // Organise getters for bracket struct
            public int seedHome
            {
                get { return sh; }
                set { if (value >= 0) { sh = value; } }
            }

            public int seedAway
            {
                get { return sa; }
                set { if (value >= 0) { sa = value; } }
            }

            public int scoreHome
            {
                get { return sch; }
                set { if (value >= 0) { sch = value; } }
            }

            public int scoreAway
            {
                get { return sca; }
                set { if (value >= 0) { sca = value; } }
            }

            public Boolean setAway
            {
                get { return seta; }
                set { if (value) { seta = value; } }
            }

            public Boolean setHome
            {
                get { return seth; }
                set { if (value) { seth = value; } }
            }

            public String playerHome
            {
                get { return ph; }
                set { if (value != null) { ph = value; } }
            }

            public String playerAway
            {
                get { return pa; }
                set { if (value != null) { pa = value; } }
            }

        }

        static void Main(string[] args)
        {
            // identify number of players
            int players;
            Console.Write("Enter total number of players: ");
            players = Convert.ToInt16(Console.ReadLine());
            Console.WriteLine("");
            // Initilise players structure as an array
            Player[] newPlayer = new Player[players];
            // Add players names and seeds
            // Manual entry
            for (int i = 0; i < newPlayer.Length; i++)
            {
                Console.Write("\nEnter Players Name: ");
                newPlayer[i].playerName = Console.ReadLine();
                Console.Write("\nEnter " + newPlayer[i].playerName + " seed position: ");
                try
                {
                    newPlayer[i].seed = Convert.ToInt16(Console.ReadLine());
                    newPlayer[i].seedSet = true;
                }
                catch
                {
                    newPlayer[i].seed = 0;
                    newPlayer[i].seedSet = false;
                }
                for (int j = 0; j < newPlayer.Length; j++)
                {
                    while (newPlayer[i].seed == newPlayer[j].seed && j != i && newPlayer[j].seed > 0)
                    {
                        if (newPlayer[i].seed < 1)
                        {
                            Console.WriteLine("This seed position has already been allocated to " + newPlayer[j].playerName);
                            Console.WriteLine("Please enter new seed position for this player: ");
                            newPlayer[i].seed = Convert.ToInt16(Console.ReadLine());
                            j = 0;
                        }
                    }
                }
            }
            /* The following are for testing purposes.
            newPlayer[0].playerName = "Gordon";
            newPlayer[1].playerName = "Nicola";
            newPlayer[2].playerName = "Emily";
            newPlayer[3].playerName = "Hannah";
            newPlayer[4].playerName = "Lucy";
            newPlayer[5].playerName = "William";
            newPlayer[6].playerName = "Alex";
            newPlayer[7].playerName = "Bob";
            //
            newPlayer[0].seed = 2;
            newPlayer[1].seed = 3;
            newPlayer[2].seed = 1;
            newPlayer[3].seed = 4;
            newPlayer[4].seed = 5;
            newPlayer[5].seed = 8;
            newPlayer[6].seed = 6;
            newPlayer[7].seed = 7;
            */
            // Cretae compare numbers to compare seeds
            int[] seedCompare = new int[players];
            Boolean[] seedIs = new Boolean[players];
            for (int i = 0; i < players; i++)
            {
                seedCompare[i] = i + 1;
                seedIs[i] = false;
            }
            for (int i = 0; i < newPlayer.Length; i++)
            {
                for (int j = 0; j < seedCompare.Length; j++)
                {
                    if (newPlayer[i].seed == seedCompare[j])
                    {
                        seedIs[j] = true;
                    }
                }
            }
            // Allocate seed position for non seeded players
            for (int i = 0; i < newPlayer.Length; i++)
            {
                if (newPlayer[i].seedSet == false)
                {
                    for (int j = 0; j < newPlayer.Length; j++)
                    {
                        for (int k = 0; k < seedCompare.Length; k++)
                        {
                            if (newPlayer[j].seed == seedCompare[k])
                            {
                                seedIs[k] = true;
                            }
                        }
                    }
                    for (int l = 0; l < seedCompare.Length; l++)
                    {
                        if (seedIs[l] == false)
                        {
                            newPlayer[i].seed = seedCompare[l];
                            newPlayer[i].seedSet = true;
                        }
                    }
                }
            }

            int counter = 0;
            /*
            for (int i = 0; i < newPlayer.Length; i++)
            {
                if (newPlayer[i].seed > 0)
                {
                    counter++;
                }
            }
            for (int i = 0; i < newPlayer.Length; i++)
            {
                if (newPlayer[i].seed == 0)
                {
                    newPlayer[i].seed = counter + 1;
                    counter++;
                }
            }
            */
            // sort player struct by seed
            for (int i = 0; i < newPlayer.Length; i++)
            {
                for (int j = 0; j < i; j++)
                {
                    if (newPlayer[i].seed.CompareTo(newPlayer[j].seed) < 0)
                    {
                        Player temp = newPlayer[i];
                        newPlayer[i] = newPlayer[j];
                        newPlayer[j] = temp;
                    }
                }
            }
            for (int i = 0; i < newPlayer.Length; i++)
            {
                Console.WriteLine("Index: " + i + " - Player: " + newPlayer[i].playerName + " - Seed: " + newPlayer[i].seed);
            }
            Console.WriteLine("");
            // identify bracket size
            Bracket[] round1 = new Bracket[8];
            Bracket[] quarter = new Bracket[4];
            Bracket[] semi = new Bracket[2];
            Bracket[] final = new Bracket[1];
            // Systematic seeding order
            int[] seedingFinal = { 1, 2 };
            int[] seedingSemi = { 1, 4, 2, 3 };
            int[] seedingQuarter = { 1, 8, 4, 5, 2, 7, 3, 6 };
            int[] seddingRound1 = { 1, 16, 8, 9, 4, 13, 5, 12, 2, 15, 7, 10, 3, 14, 6, 11 };
            int bracketSize = 0;
            if (players <= 1)
            {
                Console.WriteLine("ERROR - not enough players!");
                Console.ReadLine();
                Console.Clear();
            }
            if (players > 1 && players <= 2)
            {
                bracketSize = 1;

                final[0].seedHome = 1;
                final[0].seedAway = 2;
            }
            if (players > 2 && players <= 4)
            {
                bracketSize = 2;
                final[0].seedHome = 1;
                final[0].seedAway = 2;
                semi[0].seedHome = 1;
                semi[0].seedAway = 4;
                semi[1].seedHome = 2;
                semi[1].seedAway = 3;
            }
            if (players > 4 && players <= 8)
            {
                bracketSize = 4;
                final[0].seedHome = 1;
                final[0].seedAway = 2;
                semi[0].seedHome = 1;
                semi[0].seedAway = 4;
                semi[1].seedHome = 2;
                semi[1].seedAway = 3;
                quarter[0].seedHome = 1;
                quarter[0].seedAway = 8;
                quarter[1].seedHome = 4;
                quarter[1].seedAway = 5;
                quarter[2].seedHome = 2;
                quarter[2].seedAway = 7;
                quarter[3].seedHome = 3;
                quarter[3].seedAway = 6;
            }
            if (players > 8 && players <= 16)
            {
                bracketSize = 8;
                final[0].seedHome = 1;
                final[0].seedAway = 2;
                semi[0].seedHome = 1;
                semi[0].seedAway = 4;
                semi[1].seedHome = 2;
                semi[1].seedAway = 3;
                quarter[0].seedHome = 1;
                quarter[0].seedAway = 8;
                quarter[1].seedHome = 4;
                quarter[1].seedAway = 5;
                quarter[2].seedHome = 2;
                quarter[2].seedAway = 7;
                quarter[3].seedHome = 3;
                quarter[3].seedAway = 6;
                round1[0].seedHome = 1;
                round1[0].seedAway = 16;
                round1[1].seedHome = 8;
                round1[1].seedAway = 9;
                round1[2].seedHome = 4;
                round1[2].seedAway = 13;
                round1[3].seedHome = 5;
                round1[3].seedAway = 12;
                round1[4].seedHome = 2;
                round1[4].seedAway = 15;
                round1[5].seedHome = 7;
                round1[5].seedAway = 10;
                round1[6].seedHome = 3;
                round1[6].seedAway = 14;
                round1[7].seedHome = 6;
                round1[7].seedAway = 11;
            }
            //populate table with names based on seeds
            if (bracketSize == 1)
            {
                for (int i = 0; i < newPlayer.Length; i++)
                {
                    for (int j = 0; j < final.Length; j++)
                    {
                        if (newPlayer[i].seed == final[j].seedHome)
                        {
                            final[j].playerHome = newPlayer[i].playerName;
                            newPlayer[i].set = true;
                            final[j].setHome = true;
                            counter++;
                        }
                        if (newPlayer[i].seed == final[j].seedAway)
                        {
                            final[j].playerAway = newPlayer[i].playerName;
                            newPlayer[i].set = true;
                            final[j].setAway = true;
                            counter++;
                        }
                    }
                }
                // for players with NULL seed position
                for (int i = 0; i < newPlayer.Length; i++)
                {
                    for (int j = 0; j < final.Length; j++)
                    {
                        if (newPlayer[i].set == false && final[j].setHome == false)
                        {
                            final[j].playerHome = newPlayer[i].playerName;
                            newPlayer[i].set = true;
                            final[j].setHome = true;
                        }
                        if (newPlayer[i].set == false && final[j].setAway == false)
                        {
                            final[j].playerAway = newPlayer[i].playerName;
                            newPlayer[i].set = true;
                            final[j].setAway = true;
                        }
                    }
                }
                // set bye positions for NULL player
                for (int j = 0; j < final.Length; j++)
                {
                    if (final[j].setHome == false)
                    {
                        final[j].playerHome = "Bye";
                    }
                    if (final[j].setAway == false)
                    {
                        final[j].playerAway = "Bye";
                    }
                }
            }
            if (bracketSize == 2)
            {
                for (int i = 0; i < newPlayer.Length; i++)
                {
                    for (int j = 0; j < semi.Length; j++)
                    {
                        if (newPlayer[i].seed == semi[j].seedHome)
                        {
                            semi[j].playerHome = newPlayer[i].playerName;
                            newPlayer[i].set = true;
                            semi[j].setHome = true;
                        }
                        if (newPlayer[i].seed == semi[j].seedAway)
                        {
                            semi[j].playerAway = newPlayer[i].playerName;
                            newPlayer[i].set = true;
                            semi[j].setAway = true;
                        }
                    }
                }
                for (int i = 0; i < newPlayer.Length; i++)
                {
                    for (int j = 0; j < semi.Length; j++)
                    {
                        if (newPlayer[i].set == false && semi[j].setHome == false)
                        {
                            semi[j].playerHome = newPlayer[i].playerName;
                            newPlayer[i].set = true;
                            semi[j].setHome = true;
                        }
                        if (newPlayer[i].set == false && semi[j].setAway == false)
                        {
                            semi[j].playerAway = newPlayer[i].playerName;
                            newPlayer[i].set = true;
                            semi[j].setAway = true;
                        }
                    }
                }
                // set bye positions for NULL player
                for (int j = 0; j < semi.Length; j++)
                {
                    if (semi[j].setHome == false)
                    {
                        semi[j].playerHome = "Bye";
                    }
                    if (semi[j].setAway == false)
                    {
                        semi[j].playerAway = "Bye";
                    }
                }
            }
            if (bracketSize == 4)
            {
                for (int i = 0; i < newPlayer.Length; i++)
                {
                    for (int j = 0; j < quarter.Length; j++)
                    {
                        if (newPlayer[i].seed == quarter[j].seedHome)
                        {
                            quarter[j].playerHome = newPlayer[i].playerName;
                            newPlayer[i].set = true;
                            quarter[j].setHome = true;
                        }
                        if (newPlayer[i].seed == quarter[j].seedAway)
                        {
                            quarter[j].playerAway = newPlayer[i].playerName;
                            newPlayer[i].set = true;
                            quarter[j].setAway = true;
                        }
                    }
                }
                for (int i = 0; i < newPlayer.Length; i++)
                {
                    for (int j = 0; j < quarter.Length; j++)
                    {
                        if (newPlayer[i].set == false && quarter[j].setHome == false)
                        {
                            quarter[j].playerHome = newPlayer[i].playerName;
                            newPlayer[i].set = true;
                            quarter[j].setHome = true;
                        }
                        if (newPlayer[i].set == false && quarter[j].setAway == false)
                        {
                            quarter[j].playerAway = newPlayer[i].playerName;
                            newPlayer[i].set = true;
                            quarter[j].setAway = true;
                        }
                    }
                }
                // set bye position for NULL plyers
                for (int j = 0; j < quarter.Length; j++)
                {
                    if (quarter[j].setHome == false)
                    {
                        quarter[j].playerHome = "Bye";
                    }
                    if (quarter[j].setAway == false)
                    {
                        quarter[j].playerAway = "Bye";
                    }
                }
            }
            if (bracketSize == 4)
            {
                // display quarter games
                for (int i = 0; i < quarter.Length; i++)
                {
                    Console.WriteLine("Game " + (i + 1));
                    Console.WriteLine(quarter[i].playerHome + " VS " + quarter[i].playerAway);
                    Console.WriteLine("");
                }
                Console.WriteLine("");
                // enter scores for each quarter game
                for (int i = 0; i < quarter.Length; i++)
                {
                    if (quarter[i].playerHome == "Bye")
                    {
                        quarter[i].scoreHome = 0;
                        quarter[i].scoreAway = 1;
                    }
                    else if (quarter[i].playerAway == "Bye")
                    {
                        quarter[i].scoreHome = 1;
                        quarter[i].scoreAway = 0;
                    }
                    else
                    {
                        Console.WriteLine("Enter scores for Game " + (i + 1) + " for " + quarter[i].playerHome + " : ");
                        quarter[i].scoreHome = Convert.ToInt16(Console.ReadLine());
                        Console.WriteLine("Enter scores for Game " + (i + 1) + " for " + quarter[i].playerAway + " : ");
                        quarter[i].scoreAway = Convert.ToInt16(Console.ReadLine());
                        while (quarter[i].scoreHome == quarter[i].scoreAway)
                        {
                            Console.WriteLine("Score should not be a draw please re-enter score with a clear winner");
                            Console.WriteLine("Enter scores for Game " + (i + 1) + " for " + quarter[i].playerHome + " : ");
                            quarter[i].scoreHome = Convert.ToInt16(Console.ReadLine());
                            Console.WriteLine("Enter scores for Game " + (i + 1) + " for " + quarter[i].playerAway + " : ");
                            quarter[i].scoreAway = Convert.ToInt16(Console.ReadLine());
                        }
                    }
                }
                // re-seed players for preparation to move to semi positions
                // Winner recieves new seed position
                // Losers previous seed position gets amended to 0
                for (int j = 0; j < quarter.Length; j++)
                {
                    if (quarter[j].scoreHome.CompareTo(quarter[j].scoreAway) > 0)
                    {
                        quarter[j].seedHome = seedingSemi[j];
                        quarter[j].seedAway = 0;
                    }
                    else
                    {
                        quarter[j].seedHome = 0;
                        quarter[j].seedAway = seedingSemi[j];
                    }
                }
                // move seeded players to final position
                for (int i = 0; i < semi.Length; i++)
                {
                    for (int j = 0; j < quarter.Length; j++)
                    {
                        if (quarter[j].seedHome == semi[i].seedHome)
                        {
                            semi[i].playerHome = quarter[j].playerHome;
                        }
                        if (quarter[j].seedAway == semi[i].seedHome)
                        {
                            semi[i].playerHome = quarter[j].playerAway;
                        }
                        if (quarter[j].seedHome == semi[i].seedAway)
                        {
                            semi[i].playerAway = quarter[j].playerHome;
                        }
                        if (quarter[j].seedAway == semi[i].seedAway)
                        {
                            semi[i].playerAway = quarter[j].playerAway;
                        }
                    }
                }
                bracketSize = 2;
            }
            if (bracketSize == 2)
            {
                // display semi games
                for (int i = 0; i < semi.Length; i++)
                {
                    Console.WriteLine("Game " + (i + 1));
                    Console.WriteLine(semi[i].playerHome + " VS " + semi[i].playerAway);
                    Console.WriteLine("");
                }
                Console.WriteLine("");
                // enter scores for each semi game
                for (int i = 0; i < semi.Length; i++)
                {
                    if (semi[i].playerHome == "Bye")
                    {
                        semi[i].scoreHome = 0;
                        semi[i].scoreAway = 1;
                    }
                    else if (semi[i].playerAway == "Bye")
                    {
                        semi[i].scoreHome = 1;
                        semi[i].scoreAway = 0;
                    }
                    else
                    {
                        Console.WriteLine("Enter scores for Game " + (i + 1) + " for " + semi[i].playerHome + " : ");
                        semi[i].scoreHome = Convert.ToInt16(Console.ReadLine());
                        Console.WriteLine("Enter scores for Game " + (i + 1) + " for " + semi[i].playerAway + " : ");
                        semi[i].scoreAway = Convert.ToInt16(Console.ReadLine());
                        while (semi[i].scoreHome == semi[i].seedAway)
                        {
                            Console.WriteLine("Score should not be a draw please re-enter score with a clear winner");
                            Console.WriteLine("Enter scores for Game " + (i + 1) + " for " + semi[i].playerHome + " : ");
                            semi[i].scoreHome = Convert.ToInt16(Console.ReadLine());
                            Console.WriteLine("Enter scores for Game " + (i + 1) + " for " + semi[i].playerAway + " : ");
                            semi[i].scoreAway = Convert.ToInt16(Console.ReadLine());
                        }
                    }
                }
                // re-seed players for preparation to move to final positions
                // Winner recieves new seed position
                // Losers previous seed position gets amended to 0
                for (int j = 0; j < semi.Length; j++)
                {
                    if (semi[j].scoreHome.CompareTo(semi[j].scoreAway) > 0)
                    {
                        semi[j].seedHome = seedingFinal[j];
                        semi[j].seedAway = 0;
                    }
                    else
                    {
                        semi[j].seedHome = 0;
                        semi[j].seedAway = seedingFinal[j];
                    }
                }
                bracketSize = 1;
            }
            if (bracketSize == 1)
            {
                // move seeded players to final position
                for (int i = 0; i < final.Length; i++)
                {
                    for (int j = 0; j < semi.Length; j++)
                    {
                        if (semi[j].seedHome == final[i].seedHome)
                        {
                            final[i].playerHome = semi[j].playerHome;
                        }
                        if (semi[j].seedAway == final[i].seedHome)
                        {
                            final[i].playerHome = semi[j].playerAway;
                        }
                        if (semi[j].seedHome == final[i].seedAway)
                        {
                            final[i].playerAway = semi[j].playerHome;
                        }
                        if (semi[j].seedAway == final[i].seedAway)
                        {
                            final[i].playerAway = semi[j].playerAway;
                        }
                    }
                }
                // display final games
                Console.WriteLine("\n");
                for (int i = 0; i < final.Length; i++)
                {
                    Console.WriteLine("Game " + (i + 1));
                    Console.WriteLine(final[i].playerHome + " VS " + final[i].playerAway);
                    Console.WriteLine("");
                }
                Console.WriteLine("");
                // enter scores for each final game and set BYE to lose
                for (int i = 0; i < final.Length; i++)
                {
                    if (final[i].playerHome == "Bye")
                    {
                        final[i].scoreHome = 0;
                        final[i].scoreAway = 1;
                    }
                    else if (final[i].playerAway == "Bye")
                    {
                        final[i].scoreHome = 1;
                        final[i].scoreAway = 0;
                    }
                    else
                    {
                        Console.WriteLine("Enter scores for Game " + (i + 1) + " for " + final[i].playerHome + " : ");
                        final[i].scoreHome = Convert.ToInt16(Console.ReadLine());
                        Console.WriteLine("Enter scores for Game " + (i + 1) + " for " + final[i].playerAway + " : ");
                        final[i].scoreAway = Convert.ToInt16(Console.ReadLine());
                        while (final[i].scoreHome == final[i].seedAway)
                        {
                            Console.WriteLine("Score should not be a draw please re-enter score with a clear winner");
                            Console.WriteLine("Enter scores for Game " + (i + 1) + " for " + final[i].playerHome + " : ");
                            final[i].scoreHome = Convert.ToInt16(Console.ReadLine());
                            Console.WriteLine("Enter scores for Game " + (i + 1) + " for " + final[i].playerAway + " : ");
                            final[i].scoreAway = Convert.ToInt16(Console.ReadLine());
                        }
                    }
                }
                // determine winner
                // re-seed players for preparation to identify the winner
                // Winner recieves new seed position
                // Losers previous seed position gets amended to 0
                for (int j = 0; j < final.Length; j++)
                {
                    if (final[j].scoreHome.CompareTo(final[j].scoreAway) > 0)
                    {
                        final[j].seedHome = j + 1;
                        final[j].seedAway = 0;
                    }
                    else
                    {
                        final[j].seedHome = 0;
                        final[j].seedAway = j + 1;
                    }
                }
                for (int i = 0; i < final.Length; i++)
                {
                    if (final[i].seedHome == 1)
                    {
                        Console.WriteLine("The winner is " + final[i].playerHome);
                    }
                    if (final[i].seedAway == 1)
                    {
                        Console.WriteLine("The winner is " + final[i].playerAway);
                    }
                }
                bracketSize = 0;
            }
            Console.ReadLine();
        }
    }
}
